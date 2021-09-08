<?php

namespace App\Action\Admin;

use App\Domain\TrailLog\Service\TrailLog;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddPenaltyAction
{

    private $mail;
    private $user;
    private $traillog;
    private $location;

    public function __construct(SendMail $mail, User $user, TrailLog $traillog)
    {
        $this->mail = $mail;
        $this->user = $user;
        $this->traillog = $traillog;
        $location = dirname(__FILE__) . "/tmp/";
        if (!is_dir($location)) mkdir($location);
        $this->location = $location;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        $auth = $request->getAttribute("token")['data'];
        if ($auth->userType != "admin") {
            \http_response_code(403);
            return $response;
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (empty($args['confirmation_code'])) {
                \http_response_code(400);
                return $response;
            }

            if ($this->verifyTokenAndAddPenalty($args['confirmation_code']))
                $response->getBody()->write(json_encode(['success' => true, 'message' => "Penalty subtracted successfully"]));
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = (array) $request->getParsedBody();
            if ($this->setTokenAndSendMail($data))
                $response->getBody()->write(json_encode(['success' => true, 'message' => "Token sent successfully"]));
        }

        return $response;
    }

    private function setTokenAndSendMail($data)
    {
        if (empty($data['ID']) || empty($data['fullName']) || empty($data['userName']) || empty($data['amount'])) {
            \http_response_code(400);
            return false;
        }

        $token = substr(strtoupper(sha1(uniqid())), 5, 10);

        file_put_contents("$this->location/$token.json", json_encode($data, JSON_PRETTY_PRINT));

        return $this->mail->sendPenaltyConfirmToken($token, $data['fullName'], $data['userName'], $data['amount']);
    }

    private function verifyTokenAndAddPenalty($token)
    {
        $file = "$this->location/$token.json";

        if (!is_file($file) || !is_readable($file)) {
            \http_response_code(400);
            return false;
        }

        $d = json_decode(file_get_contents($file));

        // fetch user
        $user = (object) $this->user->readUser($d->ID);

        if (empty($user)) {
            \http_response_code(400);
            return false;
        }

        // subtract from interest wallet balance
        $this->user->updateUser($d->ID, [
            'interestWalletBalance' => $user->interestWalletBalance - $d->amount,
        ]);

        // check if you can send notification 
        if (!empty($d->sendEmailNotification)) {
            // check the notification type
            $this->mail->sendPenaltySubtractedMail(
                $user->email,
                $user->fullName,
                $d->amount,
                $d->description
            );
        }

        // notify admin
        $this->mail->sendPenaltySubtractedMailToAdmin(
            $user->userName,
            $user->fullName,
            $d->amount,
            $d->description
        );

        // then traillog
        $this->traillog->create(
            [
                'userID' => $d->ID,
                'userName' => $d->userName,
                'logType' => 'penalty',
                'transactionDetails' => $d->description,
                'transactionAdminID' => '',
                'amount' => $d->amount
            ]
        );

        unlink($file);

        return true;
    }
}
