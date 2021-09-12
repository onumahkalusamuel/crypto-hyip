<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Domain\Plans\Service\Plans;
use App\Helpers\NewsLoader;

class HomeView
{
    private $view;
    protected $newsLoader;
    protected $plans;

    public function __construct(
        PhpRenderer $view,
        NewsLoader $newsLoader,
        Plans $plans
    ) {
        $this->view = $view;
        $this->newsLoader = $newsLoader;
        $this->plans = $plans;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {

        $data = [];

        $latestNews = $this->getLatestNews();
        $investmentPlans = $this->getInvestmentPlans();

        if (!empty($latestNews)) $data['latest_news'] = $latestNews;
        if (!empty($investmentPlans)) $data['investment_plans'] = $investmentPlans;

        // return $response;
        return $this->view->render($response, 'public/pages/home.php', ['data' => $data]);
    }

    private function getLatestNews(): array
    {
        return [];
        return $this->newsLoader->coinTelegraphNews(9);
    }

    private function getInvestmentPlans(): array
    {
        // return [];
        return $this->plans->readAll(['params' => ['isActive' => 1]]);
    }
}
