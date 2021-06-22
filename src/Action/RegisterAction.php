<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Helpers\ApiRequest;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RegisterAction
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        $data = (array)$request->getParsedBody();
        $data['userType'] = 'user';

        $user_id = $this->user->createUser($data);

        if (!empty($user_id)) {

            // forward email 
            $mail = new SendMail();
            $mail->sendRegistrationEmail($data['email'], $data['fullName'], $data['userName']);

            //get user and login
            $user = $this->user->readUser($user_id);

            // run other processes
            // check for referral
            if (!empty($data['referral'])) {
                $referral = $this->user->findUser(['userName' => $data['referral']]);
                if (!empty($referral)) {
                    $refData = [
                        'referralUserID' => $referral['ID'],
                        'referralUserName' => $referral['userName'],
                        'referredUserID' => $user['ID'],
                        'referredUserName' => $user['userName']
                    ];

                    $apiRequest = new ApiRequest($request->getHeader('Authorization'));

                    $apiRequest->post('/referrals__', $refData);

                    // send mail to referrer to notify that someone registered under them
                    $mail->sendDirectReferralSignupEmail(
                        $referral['email'],
                        $referral['fullName'],
                        $user['fullName'],
                        $user['userName'],
                        $user['email']
                    );
                }
            }

            // then output
            $response->getBody()->write(json_encode([
                "success" => true,
                "message" => "Registration successful."
            ]));
        } else {
            \http_response_code(400);
            $response->getBody()->write(json_encode([
                "success" => false,
                "message" => "Unable to register account at the moment. Please try again later."
            ]));
        }

        return $response;
    }
}
