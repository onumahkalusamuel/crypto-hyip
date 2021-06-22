<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ApiRequest
{

    public $client;

    public function __construct($token = null)
    {
        $config = [];

        if (!empty($token)) {

            $config['base_uri'] = $_SERVER["REQUEST_SCHEME"] . '://api.bexfinance.ltd/';

            if ($token == "internalOverride") {

                $t = [
                    // "iss" => $_SERVER['HTTP_HOST'],
                    // "aud" => $_SERVER['HTTP_HOST'],
                    "iat" => time(),
                    "exp" => time() + 600,
                    "data" => [
                        "ID" => 1,
                        "userType" => "admin",
                        "userName" => "admin",
                    ]
                ];

                $token = "Bearer " .  JWT::encode($t, JWT::$key);
            }

            $config['headers'] = [
                'Authorization' => $token
            ];
        }

        $this->client = new Client($config);
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
