<?php

namespace App\Action;

use App\Domain\Referrals\Service\Referrals;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use App\Helpers\CryptoHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class RegisterAction
{
    private $referrals;
    private $user;
    private $session;
    private $mail;
    private $cryptoHelper;

    public function __construct(
        Referrals $referrals,
        User $user,
        Session $session,
        SendMail $sendMail,
        CryptoHelper $cryptoHelper
    ) {
        $this->referrals = $referrals;
        $this->user = $user;
        $this->session = $session;
        $this->mail = $sendMail;
        $this->cryptoHelper = $cryptoHelper;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // used to track progress
        $message = false;

        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        $referralUserName = $this->session->get('referralUserName') ?? '';
        $fullName = trim($data['fullName']);
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $password = trim($data['password']);
        $userName = trim($data['userName']);
        $btcAddress = trim($data['btcAddress']);
        $secretQuestion = trim($data['secretQuestion']);
        $secretAnswer = trim($data['secretAnswer']);

        if (empty($message) && empty($email)) {
            $message = "Please enter a valid email.";
        }

        if (empty($message) && $this->emailInUse($email)) {
            $message = "Email address already in use";
        }

        if (empty($message) && (empty($fullName) || strlen($fullName) < 6)) {
            $message = "A valid name is required";
        }

        if (empty($message) && empty($password)) {
            $message = "Password is required.";
        }

        if (empty($message) && empty($userName)) {
            $userName = $this->generateUserName($fullName);
            if ($this->userNameInUse($userName)) $message = "Username is already in use. Try another one.";
        }

        // validate btc address
        if (empty($message) && !$this->cryptoHelper->validate('btc', $btcAddress)) {
            $message = "Please enter a valid bitcoin address";
        }

        if (empty($message) && (empty($secretQuestion) || empty($secretAnswer))) {
            $message = "Secret Question and Answer must be provided.";
        }

        if (empty($message)) {
            // Invoke the Domain with inputs and retain the result
            $userId = $this->user->create(['data' => [
                'fullName' => $fullName,
                'email' => $email,
                'userName' => $userName,
                'userType' => 'user',
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'btcAddress' => $btcAddress,
                'secretQuestion' => $secretQuestion,
                'secretAnswer' => $secretAnswer
            ]]);
        }

        // responses
        if (empty($message) && !empty($userId)) {

            // send mail
            $this->mail->sendRegistrationEmail($email, $fullName, $userName);

            if ($userId === 1) {
                // admin detected
                $this->user->update(['ID' => $userId, 'data' => ['userType' => 'admin']]);
            } elseif (!empty($referralUserName)) {
                $ref = $this->user->find(['params' => [
                    'userName' => $referralUserName
                ]]);

                if (!empty($ref->ID)) {
                    try {
                        $this->referrals->create(['data' => [
                            'referralUserID' => $ref->ID,
                            'referralUserName' => $referralUserName,
                            'referredUserID' => $userId,
                            'referredUserName' => $userName
                        ]]);
                    } catch (\Exception $e) {
                    }
                }
            }
            // Clear all flash messages
            $flash = $this->session->getFlashBag();
            $flash->clear();

            // Get RouteParser from request to generate the urls
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();

            $url = $routeParser->urlFor("page", ['page' => "login"]);

            $response->getBody()->write(json_encode([
                'success' => true,
                'message' => "Account Registered Successfully",
                'redirect' => $url
            ]));

            // Redirect to protected page
            return $response;
        }

        $message = $message ?? 'Unable to process request at the moment. Please try again later';

        $response->getBody()->write(json_encode([
            'success' => false,
            'message' => $message
        ]));

        return $response->withStatus(400);
    }

    public function emailInUse($email): bool
    {
        return (bool) $this->user->find(['params' => ['email' => $email]])->ID;
    }

    public function userNameInUse($userName): bool
    {
        return (bool) $this->user->find(['params' => ['userName' => $userName]])->ID;
    }

    public function generateUserName($fullName): string
    {
        $fullName = strtolower($fullName);
        $fullName = str_replace(" ", "", $fullName);
        if (strlen($fullName) >= 20) $take = 10;
        elseif (strlen($fullName) >= 10) $take = 7;
        else $take = 5;

        $userName = substr($fullName, 0, $take);

        $userName = $userName . rand(13, 9090);

        return $userName;
    }
}
