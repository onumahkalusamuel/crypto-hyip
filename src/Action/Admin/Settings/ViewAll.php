<?php

namespace App\Action\Admin\Settings;

use App\Domain\Settings\Service\Settings;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class ViewAll
{
    protected $settings;
    protected $view;

    public function __construct(
        Settings $settings,
        View $view
    ) {
        $this->settings = $settings;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // settings
        $data['settings'] = $this->settings->settings;

        return $this->view->render($response, 'admin/settings.php', ['data' => $data]);
    }
}
