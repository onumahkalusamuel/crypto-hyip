<?php

namespace App\Action;

use DOMDocument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

/** Show login form */
class PageView
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

        // the page name
        $page = $args['page'];
        $data = [];

        // fetch data
        switch ($page) {
            case 'home': {
                $latestNews = simplexml_load_string(file_get_contents('https://cointelegraph.com/rss'));
                foreach($latestNews->item as $lt) {

                    $dom = new DOMDocument();
                    $desc = $dom
                            ->loadHTML("<body>" . $lt->description . "</body>")
                            ->getElementsByTagName('p')[1];
                            
                    $data['latest_news'][] = [
                        'title' => $lt->title,
                        'link' => $lt->link,
                        'image' => $lt->enclosure,
                        'alt' => 'ctypto news',
                        'date' => 'date',
                        'desc' => $desc,
                        'categories' => $lt->category
                    ];
                }
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
