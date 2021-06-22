<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Views\PhpRenderer;

final class PhpViewExtensionMiddleware implements MiddlewareInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var PhpRenderer
     */
    private $phpRenderer;

    public function __construct(App $app, PhpRenderer $phpRenderer)
    {
        $this->phpRenderer = $phpRenderer;
        $this->app = $app;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $this->phpRenderer->addAttribute(
            'siteSettings',
            $this->app->getContainer()->get('settings')['display_settings']
        );
        $this->phpRenderer->addAttribute('uri', $request->getUri());
        $this->phpRenderer->addAttribute('basePath', $this->app->getBasePath());
        $this->phpRenderer->addAttribute('route', $this->app->getRouteCollector()->getRouteParser());
        $this->phpRenderer->addAttribute('getTimeAgo', function ($date) {
            $time_difference = time() - strtotime($date);

            if ($time_difference < 1) {
                return 'less than 1 second ago';
            }
            $condition = array(
                12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
            );

            foreach ($condition as $secs => $str) {
                $d = $time_difference / $secs;

                if ($d >= 1) {
                    $t = round($d);
                    return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
                }
            }
        });

        return $handler->handle($request);
    }
}
