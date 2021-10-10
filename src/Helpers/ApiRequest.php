<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ApiRequest
{
    public $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get(string $url)
    {
        try {
            $response = $this->client->get($url);
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getUrl(string $url)
    {
        try {
            $response = $this->client->get($url);
            return $response->getBody();
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function post(string $url, $data)
    {
        try {
            $response = $this->client->post($url, [
                RequestOptions::JSON => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function put(string $url, $data)
    {
        try {
            $response = $this->client->put($url, [
                RequestOptions::JSON => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    public function delete(string $url, $data)
    {
        try {
            $response = $this->client->delete($url, [
                RequestOptions::JSON => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
