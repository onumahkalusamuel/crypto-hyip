<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Smarty;
use Smarty_Internal_Template;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class SmartyExtensionMiddleware implements MiddlewareInterface
{

    private $app;

    private $smarty;

    private $session;

    public function __construct(
        App $app,
        Smarty $smarty,
        Session $session
    ) {
        $this->smarty = $smarty;
        $this->app = $app;
        $this->session = $session;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $this->smarty->assign(
            'siteSettings',
            $this->app->getContainer()->get('settings')['display_settings']()
        );
        $this->smarty->assign('uri', $request->getUri());
        $this->smarty->assign('basePath', $this->app->getBasePath());
        $this->smarty->assign('route', $this->app->getRouteCollector()->getRouteParser());
        $this->smarty->assign('flashBag', $this->session->getFlashBag());
        $this->smarty->assign('getTimeAgo', function ($date = null) {

            if (empty($date)) return "";

            $time_difference = time() - strtotime($date);

            if ($time_difference < 1) {
                return 'less than a minute ago';
            }
            if ($time_difference > 172800) {
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

        $this->smarty->registerPlugin('function', 'paginationLinks',[$this, 'paginationLinks']);

        return $handler->handle($request);
    }

    public function paginationLinks($params, $template)
    {
        $return = [];
        $total_rows = $params['total_rows'];
        $total_retrieved = $params['total_retrieved'];
        $uri = $params['uri'];

        if (empty($total_rows) || empty($total_retrieved)) return;
        $get = $_GET;

        $records_per_page = (int)($get['rpp'] ?? $total_retrieved);

        if ($records_per_page == 0) return;
        $first_page = 1;
        // $return['first_page'] = $first_page;
        $current_page = $get['page'] ?? $first_page;
        $return['current_page'] = $current_page;

        $last_page = ceil((int)$total_rows / (int)$records_per_page);
        $return['last_page'];
        // page links
        // $first_page_link;
        $get['page'] = $first_page;
        $return['first_page_link'] = $uri->getPath() . "?" . http_build_query($get);

        // $prev1_page_link
        if ($current_page - 2 >= $first_page) {
            $get['page'] = $current_page - 2;
            $return['prev1_page_link'] = $uri->getPath() . "?" . http_build_query($get);
        }

        // $prev0_page_link
        if ($current_page - 1 >= $first_page) {
            $get['page'] = $current_page - 1;
            $return['prev0_page_link'] = $uri->getPath() . "?" . http_build_query($get);
        }

        // current
        $get['page'] = $current_page;
        $return['current_page_link'] = $uri->getPath() . "?" . http_build_query($get);

        if ($current_page + 1 <= $last_page) {
            $get['page'] = $current_page + 1;
            $return['next0_page_link'] = $uri->getPath() . "?" . http_build_query($get);
        }

        if ($current_page + 2 <= $last_page) {
            $get['page'] = $current_page + 2;
            $return['next1_page_link'] = $uri->getPath() . "?" . http_build_query($get);
        }

        $get['page'] = $last_page;
        $return['last_page_link'] = $uri->getPath() . "?" . http_build_query($get);

        $template->assign($params['out'], $return);
    }
}
