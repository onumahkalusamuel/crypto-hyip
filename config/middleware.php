<?php

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use App\Middleware\SmartyExtensionMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    $app->add(SmartyExtensionMiddleware::class);
    $app->add(BasePathMiddleware::class); // <--- here

    $customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $logger = null
    ) use ($app) {

        $view = $app->getContainer()->get(Smarty::class);

        $response = $app->getResponseFactory()->createResponse();

        $message = openssl_encrypt(
            $exception->getCode() . " ::: " . $exception->getMessage(),
            openssl_get_cipher_methods()[0],
            "CryptoHYIP"
        );
        if ($_ENV['APP_ENV'] == 'dev') {
            $message = $exception->getMessage() . $exception->getLine() . $exception->getFile();
        }

        $view->assign("message", $message);
        $view->display("500.tpl");
        return $response;
    };

    // // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
};


function decrypter($encoded): string
{
    return (string) openssl_decrypt($encoded, openssl_get_cipher_methods()[0], "CryptoHYIP");
}
