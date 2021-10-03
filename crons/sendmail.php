<?php

use Illuminate\Database\Connection;

$app = (require __DIR__ . '/../config/bootstrap.php');
$container = $app->getContainer();
$connection = $container->get(Connection::class);

use App\Domain\QueuedJobs\Repository\QueuedJobsRepository;
use App\Domain\User\Repository\UserRepository;
use App\Helpers\SendMail;

// construct the needed classes
$queuedJobsRepository = new QueuedJobsRepository($connection);
$userRepository = new UserRepository($connection);
$sendMail = new SendMail($container);

// fetch all pending mail jobs
$jobs = $queuedJobsRepository->readAll([
    'params' => [
        'where' => ['status' => 'queued', 'type' => 'mail']
    ]
]);

if (empty($jobs)) {
    exit();
}

$totalSent = 0;

// loop through each
foreach ($jobs as $job) {

    // arrest the sending on time
    if ($totalSent >= 200) break;

    // decode the data,
    $data = json_decode($job->data, true);

    // get the userIds,
    $userIds = explode(",", $data['to']);

    while (!empty($userIds) && $totalSent < 200) {
        $currentUserId = array_shift($userIds);
        $user = $userRepository->readSingle(['ID' => $currentUserId]);
        if (empty($user->ID)) continue;

        $mailMessage = str_replace(
            ['#name#', '#username#', '#email#', '#date_register#'],
            [$user->fullName, $user->userName, $user->email, $user->createdAt],
            $data['message']
        );

        $send = $sendMail->send([
            'email' => $user->email,
            'name' => $user->fullName,
            'subject' => $data['subject'],
            'message' => $mailMessage,
        ]);

        if (empty($send['success'])) {
            $userIds[] = $currentUserId;
            logMessage('error', 'Queue: ' . $job->ID . '; User: ' . $user->ID . '; Message: '  . $send['message']);
            break;
        }

        $totalSent++;
    }

    $status =  empty($userIds) ? 'completed' : 'queued';

    $data['to'] = implode(",", $userIds);

    $queuedJobsRepository->update([
        'ID' => $job->ID,
        'data' => [
            'data' => json_encode($data),
            'status' => $status
        ],
    ]);
}

//exit application
function logMessage($type, $message)
{
    $dir = __DIR__ . '/../logs/crons/' . date("Y-M");

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $message = "[" . date("Y-m-d H:i:s", time()) . "] {$message} \n";

    $file = "{$dir}/mail-{$type}.txt";

    file_put_contents($file, $message, FILE_APPEND);
}
