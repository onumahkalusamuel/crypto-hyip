<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class JsonResponseMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        //not found
        if (\http_response_code() === 404) {
            if (strlen($response->getBody()) < 3) {
                $response = new Response;
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'not found'
                ]));
            }
        }

        // incomplete paramaters
        if (\http_response_code() === 400) {
            if (strlen($response->getBody()) < 3) {
                $response = new Response;
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'bad request'
                ]));
            }
        }

        // unathorized
        if (\http_response_code() === 403) {
            if (strlen($response->getBody()) < 3) {
                $response = new Response;
                $response->getBody()->write(json_encode([
                    'success' => false,
                    'message' => 'unauthorized access'
                ]));
            }
        }

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Cache-Control', 'no-cache')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, Access-Control-Allow-Methods, Cache-Control')
            ->withStatus(\http_response_code());
    }
}
