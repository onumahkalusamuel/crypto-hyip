<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Helpers\NewsLoader;
use App\Domain\Plans\Service\Plans;

class PageView
{
    private $view;
    private $plans;

    public function __construct(
        PhpRenderer $view,
        Plans $plans
    ) {
        $this->view = $view;
        $this->plans = $plans;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        // the page name
        $page = $args['page'];
        $data = [];

        // fetch data
        switch ($page) {
            case 'investment-plans': {
                    $data['investment_plans'] = $this->plans->readAll(['params' => ['isActive' => 1]]);
                    break;
                }
            case 'latest-news': {
                    $news = new NewsLoader;
                    $data['latest_news'] = $news->coinTelegraphNews(20);
                    break;
                }

            default:
                # code...
                break;
        }

        // fetch the page
        return $this->view->render($response, "public/pages/{$page}.php", $data);
    }
}
