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

final class UpdateAdminAction
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

        $message = false;
        $ID = $this->session->get('ID');
        $data = (array) $request->getParsedBody();

        // validate otp
        $file = $this->container->get('settings')['temp'] . '/.admin-otp';
        $token = file_get_contents($file);

        if ((filemtime($file) + 300) < time() || $data['OTP'] !== $token) {
            $message = "Token invalid or expired.";
        }

        if ((int)$ID !== 1) {
            $message = "Operation forbidden.";
        }

        $user = $this->user->readSingle(['ID' => $ID, 'select' => ['ID', 'password']]);

        if (empty($message) && empty($user->ID)) {
            $message = "Admin account not found.";
        }

        if (empty($message) && $data['newPassword'] !== $data['newPasswordAgain']) {
            $message = "The two passwords did not match.";
        }

        if (empty($message) && !password_verify($data['oldPassword'], $user->password)) {
            $message = "Invalid password provided.";
        }

        if (empty($message)) {
            $update = $this->user->update([
                'ID' => $ID,
                'data' => [
                    'password' => password_hash($data['newPassword'], PASSWORD_BCRYPT)
                ]
            ]);

            if ($update) {
                $this->sendMail->sendAdminPasswordChangedMail();
            }
        }

        // Clear all flash messages
        $flash = $this->session->getFlashBag();
        $flash->clear();

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        $url = $routeParser->urlFor('admin-settings');


        if (empty($message)) {
            $flash->set('success', "Settings updated successfully.");
        } else {
            $flash->set('error', $message);
        }

        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
