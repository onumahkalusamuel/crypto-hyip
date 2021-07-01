<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use App\Middleware\PhpViewExtensionMiddleware;
use Slim\Views\PhpRenderer;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    $app->add(PhpViewExtensionMiddleware::class);
    $app->add(BasePathMiddleware::class); // <--- here

    $customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $logger = null
    ) use ($app) {

        //$logger->error($exception->getMessage());

        $view = $app->getContainer()->get(PhpRenderer::class);
        
        $response = $app->getResponseFactory()->createResponse();

        $errorPage = "404.php";

        $code = $exception->getCode();

        if ($code === 500) $errorPage = "500.php";
        
        return $view->render($response, $errorPage);

    };

    // // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
};
