<?php

namespace App\Action\Admin\Settings;

use Psr\Container\ContainerInterface;
use App\Domain\Settings\Service\Settings;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class UpdateAdminOTPAction
{
    private $settings;
    private $user;
    private $session;
    private $container;
    private $sendMail;

    public function __construct(
        Settings $settings,
        User $user,
        Session $session,
        ContainerInterface $container,
        SendMail $sendMail
    ) {
        $this->settings = $settings;
        $this->user = $user;
        $this->session = $session;
        $this->container = $container;
        $this->sendMail = $sendMail;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-settings');

        // generate otp
        $token = substr(strtoupper(sha1(uniqid())), 5, 10);

        //  save otp
        $file = $this->container->get('settings')['temp'] . '/.admin-otp';
        if (file_put_contents($file, $token)) {
            $this->sendMail->sendAdminPasswordChangeOTP($token);

            $flash->set('success', "OTP sent to admin email. It will expire in 5 minutes.");
        } else {
            $flash->set('error', "Unable to send OTP at the moment. Please try again later.");
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
