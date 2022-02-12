<?php

namespace App\Action\User;

use App\Domain\User\Service\User;
use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ProfileView
{
    protected $user;
    protected $settings;
    protected $view;

    public function __construct(
        User $user,
        Settings $settings
    ) {
        $this->user = $user;
        $this->settings = $settings;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $request->getAttribute('token')['data']->ID;
        $select = ['ID', 'fullName', 'userName', 'email'];
        foreach ($GLOBALS['activeCurrencies'] as $currency) {
            $select[] = $currency . 'Address';
            $select[] = $currency . 'Balance';
        }
        // users
        $user = $this->user->readSingle([
            'ID' => $ID,
            'select' => $select
        ]);

        $data['profile'] = $user;

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data
        ]));

        return $response;
    }
}
