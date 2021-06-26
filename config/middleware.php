<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use App\Middleware\PhpViewExtensionMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();


    $app->add(PhpViewExtensionMiddleware::class);
    $app->add(BasePathMiddleware::class); // <--- here

    // $customErrorHandler = function (
    //     ServerRequestInterface $request,
    //     Throwable $exception,
    //     bool $displayErrorDetails,
    //     bool $logErrors,
    //     bool $logErrorDetails,
    //     ?LoggerInterface $logger = null
    // ) use ($app) {

    //     $payload = ['success' => false, 'message' => $exception->getMessage()];

    //     $response = $app->getResponseFactory()->createResponse();
    //     $response->getBody()->write(
    //         json_encode($payload, JSON_UNESCAPED_UNICODE)
    //     );

    //     \http_response_code($exception->getCode());
    //     return $response;
    // };

    // // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    // $errorMiddleware->setDefaultErrorHandler($customErrorHandler);

};
