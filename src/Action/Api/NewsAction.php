<?php

namespace App\Action\Api;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Helpers\NewsLoader;

class NewsAction
{
    protected $newsLoader;

    public function __construct(NewsLoader $newsLoader)
    {
        $this->newsLoader = $newsLoader;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        $channel = $args['channel'] ?? 'cointelegraph';
        $count = $_GET['count'] ?? 10;

        switch ($channel) {
            case 'cointelegraph': {
                    $latestNews = $this->newsLoader->coinTelegraphNews($count);
                    break;
                }
            case 'bitcoinnews': {
                    $latestNews = $this->newsLoader->coinTelegraphNews($count);
                    break;
                }
            default: {
                    $latestNews = [];
                }
        }

        $response->getBody()->write(json_encode($latestNews));

        return $response;
    }
}
