<?php

use App\Middleware\AppAuthMiddleware;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Selective\BasePath\BasePathMiddleware;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Tuupola\Middleware\JwtAuthentication;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    BasePathMiddleware::class => function (ContainerInterface $container) {
        return new BasePathMiddleware($container->get(App::class));
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },

    // AppAuth
    AppAuthMiddleware::class => function (ContainerInterface $container) {
        $auth = new JwtAuthentication([
            "secret" => $container->get('settings')['jwt_key'],
            "secure" => false,
            "path" => "/api/user",
            "error" => function ($response, $arguments) {
                http_response_code(401);
                $data["success"] = false;
                $data["message"] = $arguments["message"];
                return $response
                    ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
        ]);

        return $auth;
    },

    // Database connection
    Connection::class => function (ContainerInterface $container) {
        $factory = new ConnectionFactory(new IlluminateContainer());

        $connection = $factory->make($container->get('settings')['db']);

        // Disable the query log to prevent memory issues
        $connection->disableQueryLog();

        return $connection;
    },

    PDO::class => function (ContainerInterface $container) {
        return $container->get(Connection::class)->getPdo();
    },

    Smarty::class => function (ContainerInterface $container) {
        $smarty = new Smarty();
        $smarty->setTemplateDir($container->get('settings')['smarty']['template_dir']);
        $smarty->setCompileDir($container->get('settings')['smarty']['compile_dir']);
        $smarty->setConfigDir($container->get('settings')['smarty']['config_dir']);
        $smarty->setCacheDir($container->get('settings')['smarty']['cache_dir']);
        $smarty->debugging = $_ENV['APP_ENV'] == 'dev';
        return $smarty;
    },

    Session::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['session'];

        if (PHP_SAPI === 'cli') {
            return new Session(new MockArraySessionStorage());
        } else {
            return new Session(new NativeSessionStorage($settings));
        }
    },

    SessionInterface::class => function (ContainerInterface $container) {
        return $container->get(Session::class);
    },
];
