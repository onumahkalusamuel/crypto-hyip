<?php

namespace App\Action\Admin\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Domain\User\Service\User;
use App\Domain\TrailLog\Service\TrailLog;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Slim\Routing\RouteContext;

final class ApproveAction
{
    private $withdrawals;
    private $user;
    private $trailLog;
    private $session;
    private $sendMail;

    public function __construct(
        Withdrawals $withdrawals,
        User $user,
        TrailLog $trailLog,
        Session $session,
        SendMail $sendMail
    ) {
        $this->withdrawals = $withdrawals;
        $this->user = $user;
        $this->trailLog = $trailLog;
        $this->session = $session;
        $this->sendMail = $sendMail;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $message = false;

        // fettch withdrawal
        $withdrawal = $this->withdrawals->readSingle(['ID' => $args['id']]);

        if (empty($withdrawal->ID)) {
            $message = "Withdrawal not found.";
        }

        // check for status
        if (empty($message) && $withdrawal->withdrawalStatus !== "pending") {
            $message = "You can only approve a pending withdrawal";
        }

        // get user
        if (empty($message)) {
            $user = $this->user->readSingle(['ID' => $withdrawal->userID]);
            if (empty($user->ID)) $message = "User not found";
        }

        if (empty($message)) {
            $this->withdrawals->beginTransaction();

            try {
                // mark withdrawal as approved
                $this->withdrawals->update([
                    'ID' => $withdrawal->ID,
                    'data' => [
                        'withdrawalStatus' => 'approved'
                    ]
                ]);

                // remove from user's balance
                $balance = $withdrawal->cryptoCurrency . "Balance";
                $this->user->update([
                    'ID' => $user->ID,
                    'data' => [
                        $balance => $user->$balance - $withdrawal->amount
                    ]
                ]);

                // add record to traillog
                $this->trailLog->create([
                    'data' => [
                        'userID' => $withdrawal->userID,
                        'userName' => $withdrawal->userName,
                        'logType' => 'withdrawal',
                        'transactionDetails' => "Withdrawal of \${$withdrawal->amount} Approved",
                        'transactionID' => $withdrawal->ID,
                        'amount' => $withdrawal->amount,
                        'cryptoCurrency' => $withdrawal->cryptoCurrency
                    ]
                ]);

                $withdrawalAddress = empty(trim($withdrawal->withdrawalAddress))
                    ? $this->btcAddress()
                    : $withdrawal->withdrawalAddress;


                $this->sendMail->sendWithdrawalSentEmail(
                    $user->email,
                    $withdrawal->cryptoCurrency,
                    $withdrawal->amount,
                    $user->fullName,
                    $user->userName,
                    $withdrawalAddress,
                    hash('sha256', $withdrawal->ID)
                );

                $this->withdrawals->commit();
            } catch (\Exception $e) {
                $this->withdrawals->rollback();
                $message = "Unable to process request at the moment. Please try again later";
                $user->password = null;
                \file_put_contents(__DIR__ . '/error-' . $user->ID . $withdrawal->ID . ".json", json_encode([$user, $withdrawal, $e]));
            }
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-withdrawals');


        if (empty($message)) {
            $flash->set('success', "Withdrawal approved successfully");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }

    private function btcAddress(): string
    {
        $adds = [
            "1FBZvJnSYjyJxTKV55tJzsVCbcHW1cLzJH",
            "1PrCx3abdZVeUL88uLwxvgcP5dQBGNvR1t",
            "1H6KTkM5xSJ7P67daj1BU6e9WRqTHjWsCV",
            "16bpYSntSutfpE3FTEttnhVkQWdyQuE4Cr",
            "1F3mYj8NnrRqVQfRehfQGNQhH2JBMfHhNG",
            "1MyrK4C4LHxQfk7tDun3PhQU5529vK66dX",
            "1P9TyDtGXMSkmQHRVkWfwRw3DGuA2TbpoY",
            "1EoQKQtHMyt9w9az5HSkATC2CRWjHEcbgW",
            "16Yaq3FDrWbFxtBpb32Gv4zR3JDqvHy1cw",
            "1HKuxexZQdf58xxXDBUJC2KmjiD3e5rWmQ",
            "1LeLKXoLMwH58oE2T75HwqeFBJgiCxpFdq",
            "1B5CSXqGxQU993iHCUh2MAt9AvvXhVzh4P",
            "1GPmv1fasaWh6kAjGfNNU2CJhcSFmQHB8y",
            "19HAB3Z3CeAmG9hD8nZ3z3S6abr53mjg6N",
            "1E5RgCq7tSw8bnjYjcGFVqgkriPmSZvepX",
            "13kQAPaDSGZ24PQa6R69WCFgQT3JBZEq2w",
            "1FFeW2UP1DRwTH8GgrvYk6mbfEuG8fBDtf",
            "15tPaJXZuHyVDSdnbvjKyXy7uWzTL1uJTa",
            "124ihyh8DNHXxjynGsUgGi3USqu1naJcvK",
            "16ZNCsUV8GJ4EAMQ7QUr26dCx5pydfw9Qy",
            "1Fqz2cGg3VGgAEbSHs1bLnwSPzZUBcjNFB",
            "1675UidfbB15TkDG1j7TUeJHPn7NPVhJsL",
            "1Jb4cHW1Po4Tadv6dU3a1jkvZ5Gr6U7cYn",
            "1M41z31TAnJKNCQiiZEq9Fx6aPt19q14ow",
            "16Dk51XhQ72QYdaJVx245CKYTCoygWKdME",
            "1FJ12Th4BycTMKzkKmBGWG1nBopQw2KtNr",
            "12FnfEPX7ebAcYj3E3xqRhnEh5njP6q1nM",
            "1M6EbYMMxVS44tFMY8MHdkX58LZiHH3E9",
            "1LzCjxVdBaXdcDgcVy6yd5FNbhavXBbeAL",
            "15poHh8C5Sxx4bxTiKak1EQQgCAGqD19y2",
        ];
        shuffle($adds);
        shuffle($adds);
        return array_pop($adds);
    }
}
