<?php

namespace App\Action\Admin\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class ViewAll
{
    protected $plans;
    protected $view;

    public function __construct(
        Plans $plans,
        View $view
    ) {
        $this->plans = $plans;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // plans
        $plans = $this->plans->readAll([]);

        // prepare the return data
        $data = [
            'plans' => $plans
        ];

        return $this->view->render($response, 'admin/plans.php', ['data' => $data]);
    }
}
