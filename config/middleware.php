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

        $view = $app->getContainer()->get(PhpRenderer::class);

        $response = $app->getResponseFactory()->createResponse();

        $message = openssl_encrypt(
            $exception->getCode() . " ::: " . $exception->getMessage(),
            openssl_get_cipher_methods()[0],
            "CryptoHYIP"
        );
        $message = $exception->getMessage();

        return $view->render($response, "500.php", ['message' => $message]);
    };

    // // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
};


function decrypter($encoded): string
{
    return (string) openssl_decrypt($encoded, openssl_get_cipher_methods()[0], "CryptoHYIP");
}
