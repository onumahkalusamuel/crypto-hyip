<?php

use Illuminate\Database\Connection;

$app = (require __DIR__ . '/../config/bootstrap.php');
$container = $app->getContainer();
$connection = $container->get(Connection::class);

use App\Domain\Deposits\Repository\DepositsRepository;
use App\Domain\User\Repository\UserRepository;
use App\Domain\TrailLog\Repository\TrailLogRepository;

// construct the needed classes
$depositRepository = new DepositsRepository($connection);
$userRepository = new UserRepository($connection);
$trailLogRepository = new TrailLogRepository($connection);

// release all deposits that the final interest date has passed

// fetch all pending deposits
$deposits = $depositRepository->readAll([
    'params' => [
        'where' => ['depositStatus' => 'approved']
    ]
]);

if (empty($deposits)) {
    logMessage("info", "No deposits to process");
    exit();
}

$now = time();

// loop through each
foreach ($deposits as $deposit) {

    // find user first
    $user = $userRepository->readSingle(['ID' => $deposit->userID]);
    if (empty($user->ID)) {
        // deposit without a user detected. Delete asap
        $depositRepository->delete(['ID' => $deposit->ID]);
        logMessage("info", "User {$deposit->userName} ({$deposit->userID}) seems to have disappeared, leaving Deposit {$deposit->ID} as an orphan. Let the orphan go home!");
        continue;
    }

    if (empty($user->isActive)) {
        // user inactive
        logMessage("info", "User {$deposit->userName} inactive!");
        continue;
    }

    // set a reference date for calculations
    // use the deposit approval date if the last interest date is still null.
    $referenceDate = !empty($deposit->lastInterestDate) ? $deposit->lastInterestDate : $deposit->depositApprovalDate;

    // check the interest plan, see whether the current time is good to pay interest
    switch ($deposit->profitFrequency) {
        case 'yearly': {
                $minimumInterval = 1 * 52 * 7 * 24 * 60 * 60; // yr*wk*dy*hr*min*secs
                break;
            }
        case 'monthly': {
                $minimumInterval = 1 * 4 * 7 * 24 * 60 * 60; // mnt*wk*dy*hr*min*secs
                break;
            }
        case 'weekly': {
                $minimumInterval = 1 * 7 * 24 * 60 * 60; // wk*dy*hr*min*secs
                break;
            }
        case 'daily': {
                $minimumInterval = 1 * 24 * 60 * 60; // dy*hr*min*secs
                break;
            }
        case 'hourly': {
                $minimumInterval = 1 * 60 * 60; // hr*min*secs
                break;
            }
        case 'end': {
                // should be end of plan
                $minimumInterval = strtotime($deposit->finalInterestDate) - strtotime($referenceDate) - 10 * 60; // give 10 minutes grace
                break;
            }
        default: {
                logMessage('error', "Unable to detect profitFrequency for {$deposit->ID}");
                break;
            }
    }

    if (empty($minimumInterval)) continue;

    // be sure there is a date to work with
    if (empty($referenceDate)) {
        logMessage('error', "{$deposit->ID} has issue with depositApprovalDate and lastInterestDate.");
        continue;
    }

    // check time difference between now and when interest was last paid
    $timeDiff = $now - strtotime($referenceDate);

    // check if deposit is qualified to receive interest right now
    if ($timeDiff < $minimumInterval) continue;

    // it is good to pay
    // start transaction
    $depositRepository->beginTransaction();
    try {
        // calculate interest and add pay
        $interest = round($deposit->percentage / 100 * $deposit->amount, 2);

        $wallet = $deposit->cryptoCurrency . "Balance";
        $user->$wallet = $user->$wallet + $interest;

        $userRepository->update([
            'ID' => $user->ID,
            'data' => [$wallet => $user->$wallet]
        ]);

        // update the deposit last paid interest
        $depositRepository->update([
            'ID' => $deposit->ID,
            'data' => [
                'lastInterestDate' => date("Y-m-d H:i:s", $now),
                'interestBalance' => $deposit->interestBalance + $interest
            ]
        ]);

        // add the record to logs too
        $trailLogRepository->create([
            'data' => [
                'userID' => $user->ID,
                'userName' => $user->userName,
                'logType' => 'deposit-earning',
                'cryptoCurrency' => $deposit->cryptoCurrency,
                'transactionDetails' => "Earning from deposit of $" . $deposit->amount . " - " . $deposit->percentage . "%",
                'transactionID' => $deposit->ID,
                'amount' => $interest
            ]
        ]);
        // commit transaction
        $depositRepository->commit();

        // log success
        logMessage('success', "Earning of \${$interest} ({$deposit->cryptoCurrency}) added to {$user->userName}.");
    } catch (\Exception $e) {
        // log the error
        $depositRepository->rollback();
        logMessage('error', "{$e->getMessage()}, in file: {$e->getFile()}, line {$e->getLine()}");
        continue;
    }

    // then check up on releases
    // verify that its end of plan or interest date not passed
    if (($deposit->profitFrequency === "end") || empty($deposit->finalInterestDate) || strtotime($deposit->finalInterestDate) < $now) {
        // release deposits that have passed
        $depositRepository->beginTransaction();
        try {
            $depositRepository->update([
                'ID' => $deposit->ID,
                'data' => [
                    'depositStatus' => 'released',
                ]
            ]);

            $wallet = $deposit->cryptoCurrency . "Balance";


            $userRepository->update([
                'ID' => $user->ID,
                'data' => [$wallet => $user->$wallet + $deposit->amount]
            ]);

            // trail log
            $trailLogRepository->create([
                'data' => [
                    'userID' => $user->ID,
                    'userName' => $user->userName,
                    'logType' => 'deposit-release',
                    'cryptoCurrency' => $deposit->cryptoCurrency,
                    'transactionDetails' => "Deposit amount \${$deposit->amount} released",
                    'transactionID' => $deposit->ID,
                    'amount' => "-" . $deposit->amount
                ]
            ]);

            // commit finally
            $depositRepository->commit();
            logMessage('info', "Deposit ({$deposit->ID}) released.");
        } catch (\Exception $e) {
            $depositRepository->rollback();
            logMessage('error', "{$e->getMessage()}, in file: {$e->getFile()}, line {$e->getLine()}");
        }
        continue;
    }
}

//exit application
function logMessage($type, $message)
{
    $dir = __DIR__ . '/../logs/crons/' . date("Y-M");

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $message = "[" . date("Y-m-d H:i:s", time()) . "] {$message} \n";

    $file = "{$dir}/$type.txt";

    file_put_contents($file, $message, FILE_APPEND);
}
