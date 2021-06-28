<?php

namespace App\Action\Admin\Settings;

use App\Domain\Settings\Service\Settings;
use App\Domain\User\Service\User;
use App\Helpers\SendMail;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;

final class UpdateSettingsAction
{
    private $settings;
    private $user;
    private $session;

    public function __construct(Settings $settings, User $user, Session $session)
    {
        $this->settings = $settings;
        $this->user = $user;
        $this->session = $session;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $message = false;
        $ID = $this->session->get('ID');
        $data = (array) $request->getParsedBody();

        if ((int)$ID !== 1) {
            $message = "Operation forbidden.";
        }

        $user = $this->user->readSingle(['ID' => $ID, 'select' => ['ID', 'password']]);

        if (empty($message) && empty($user->ID)) {
            $message = "Admin account not found.";
        }

        if (empty($message) && !password_verify($data['confirmPassword'], $user->password)) {
            $message = "Invalid password provided.";
        }

        if (empty($message)) {
            $this->settings->btcDepositAddress = $data['btcDepositAddress'];
            $this->settings->minWithdrawal = $data['minWithdrawal'];
            $this->settings->payReferral = $data['payReferral'];

            $mail = new SendMail();
            $mail->sendSettingsChangedMail();
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
