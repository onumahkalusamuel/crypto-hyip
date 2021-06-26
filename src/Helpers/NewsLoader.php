<?php

namespace App\Helpers;

use DOMDocument;

class NewsLoader
{

    private $streamContext;

    private $coinTelegraphRss = "https://cointelegraph.com/rss";

    public function __construct()
    {
        $this->streamContext = stream_context_create(
            array('http' => array('timeout' => 3))
        );
    }

    public function coinTelegraphNews($count = 20): array
    {
        $latestNews = [];
        try {
            $latestNews =  $this->fetchCoinTelegraphNews($count);
            shuffle($latestNews);
        } catch (\Exception $e) {
            // check if there is a local copy
            $latestNews = (array) json_decode(
                file_get_contents(
                    __DIR__ . "/newscache/cointelegraph.json"
                ),
                true
            );
            // pick $count
            $latestNews = array_chunk($latestNews, $count)[0];
        }

        return $latestNews;
    }

    public function fetchCoinTelegraphNews($count = 40): array
    {
        $latestNews = [];

        $dom = new DOMDocument();
        $dom2 = new DOMDocument();

        $source = file_get_contents($this->coinTelegraphRss, false, $this->streamContext);

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

            if ($key >= $count) break;
        }

        return $latestNews;
    }
}
