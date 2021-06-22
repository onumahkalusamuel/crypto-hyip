<?php

namespace App\Action;

use DOMDocument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

/** Show login form */
class HomeView
{
    /**
     * View handler
     *
     * @var \Slim\Views\PhpRenderer
     */
    private $view;

    /**
     * Constructor
     *
     * @param \Slim\Views\PhpRenderer $view
     */
    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
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
        $latestNews = [];

        $dom = new DOMDocument();
        $dom2 = new DOMDocument();

        $source = file_get_contents('https://cointelegraph.com/rss');

        if (empty($source)) return $latestNews;

        $dom->loadXML($source);

        $title = $dom->getElementsByTagName('title')[0]->nodeValue;
        $items = $dom->getElementsByTagName('item');
        foreach ($items as $key => $item) {

            $latestNews[$key]['author'] = $title;
            $latestNews[$key]['title'] = $item->getElementsByTagName('title')[0]->nodeValue;
            $latestNews[$key]['link'] = $item->getElementsByTagName('link')[0]->nodeValue;
            $latestNews[$key]['image'] = $item->getElementsByTagName('enclosure')[0]->getAttribute('url');
            $latestNews[$key]['date'] = $item->getElementsByTagName('pubDate')[0]->nodeValue;

            $categories = $item->getElementsByTagName('category');
            foreach ($categories as $category) {
                $latestNews[$key]['categories'][] = $category->nodeValue;
            }

            $dom2->loadHTML($item->getElementsByTagName('description')[0]->nodeValue);
            $latestNews[$key]['desc'] = $dom2->getElementsByTagName('p')[1]->nodeValue;

            if ($key >= 9) break;
        }

        shuffle($latestNews);
        
        return $latestNews;
    }

    private function getInvestmentPlans(): array
    {
        $plans = [
            [
                'title' => 'GOLD',
                'price' => 40,
                'is_featured' => false,
                'features' => ['Early Payment', 'Instant Withdrawal', 'Insane referrals']
            ],
            [
                'title' => 'PLATINUM',
                'price' => 70,
                'is_featured' => true,
                'features' => ['Early Payment', 'Instant Withdrawal', 'Insane referrals']
            ],
            [
                'title' => 'ENTERPRISE',
                'price' => 1000,
                'is_featured' => false,
                'features' => ['Early Payment', 'Instant Withdrawal', 'Insane referrals']
            ]
        ];

        return $plans;
    }
}
