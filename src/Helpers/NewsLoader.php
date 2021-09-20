<?php

namespace App\Helpers;

use DOMDocument;

class NewsLoader
{

    private $streamContext;

    private $coinTelegraphRss = "https://cointelegraph.com/rss";

    private $cacheLocation = "";

    public function __construct()
    {
        $this->streamContext = stream_context_create(
            array('http' => array('timeout' => 3))
        );
        // cache location
        $this->cacheLocation = dirname(dirname(__DIR__)) . '/tmp/newscache/';
        if (!is_dir($this->cacheLocation)) mkdir($this->cacheLocation, 0777, true);
    }

    public function coinTelegraphNews($count = 20): array
    {
        $latestNews = [];
        $fetch = [];
        try {
            $fetch = $this->fetchCoinTelegraphNews();
        } catch (\Exception $e) {
        }

        if (!empty($fetch)) {
            shuffle($fetch);
            shuffle($fetch);
            for ($i = 0; $i < $count; $i++) {
                if (empty($fetch[$i])) break;
                $latestNews[] = $fetch[$i];
            }
        }

        return $latestNews;
    }

    public function fetchCoinTelegraphNews($count = 50): array
    {
        $latestNews = [];
        $file = $this->cacheLocation . "cointelegraph.json";

        if (is_file($file) && time() < filemtime($file) + 21600) {
            return (array) json_decode(
                file_get_contents($this->cacheLocation . "cointelegraph.json"),
                true
            );
        }

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
                $latestNews[$key]['tags'][] = $category->nodeValue;
                if (count($latestNews[$key]['tags']) == 3) break;
            }

            $dom2->loadHTML($item->getElementsByTagName('description')[0]->nodeValue);
            $latestNews[$key]['desc'] = $dom2->getElementsByTagName('p')[1]->nodeValue;

            if ($key >= $count) break;
        }

        $this->cacheNews('cointelegraph', $latestNews);

        return $latestNews;
    }

    private function cacheNews(string $channel, array $content): void
    {
        $file = $this->cacheLocation . "{$channel}.json";

        // check file existence. nb: caching for 6 hours
        if (empty($content) || (is_file($file) && time() < filemtime($file) + 21600)) {
            return;
        }

        file_put_contents($file, json_encode($content));
    }
}
