<?php

namespace App\Action;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;

class PageView
{
    private $view;

    public function __construct(Smarty $view)
    {
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        // the page name
        $page = $args['page'] ?? 'home';

        // fetch the page
        try {
            $this->view->display("theme/public/pages/{$page}.tpl");
        } catch (\Exception $e) {
            throw new Exception($e);
            // $this->view->display("500.tpl");
        }
        return $response;
    }
}
