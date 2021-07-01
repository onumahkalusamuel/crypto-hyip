<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Views\PhpRenderer;
use Laminas\Escaper\Escaper;
use Symfony\Component\HttpFoundation\Session\Session;


final class PhpViewExtensionMiddleware implements MiddlewareInterface
{

    private $app;

    private $phpRenderer;

    private $session;

    private $escaper;

    public function __construct(
        App $app,
        PhpRenderer $phpRenderer,
        Session $session,
        Escaper $escaper
    ) {
        $this->phpRenderer = $phpRenderer;
        $this->app = $app;
        $this->session = $session;
        $this->escaper = $escaper;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $this->phpRenderer->addAttribute(
            'siteSettings',
            $this->app->getContainer()->get('settings')['display_settings']()
        );
        $this->phpRenderer->addAttribute('uri', $request->getUri());
        $this->phpRenderer->addAttribute('basePath', $this->app->getBasePath());
        $this->phpRenderer->addAttribute('route', $this->app->getRouteCollector()->getRouteParser());
        $this->phpRenderer->addAttribute('flashBag', $this->session->getFlashBag());
        $this->phpRenderer->addAttribute('esc', $this->escaper);
        $this->phpRenderer->addAttribute('getTimeAgo', function ($date = null) {

            if(empty($date)) return "";

            $time_difference = time() - strtotime($date);

            if ($time_difference < 1) {
                return 'less than a minute ago';
            }
            if($time_difference > 172800) {
                return date("d M, Y", strtotime($date));
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
