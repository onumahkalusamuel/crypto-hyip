<?php

namespace App\Middleware;

use App\Domain\Plans\Service\Plans;
use App\Domain\Settings\Service\Settings;
use App\Helpers\NewsLoader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Smarty;
use Symfony\Component\HttpFoundation\Session\Session;

final class SmartyExtensionMiddleware implements MiddlewareInterface
{

    private $app;
    private $smarty;
    private $session;
    private $plans;
    private $settings;

    public function __construct(
        App $app,
        Smarty $smarty,
        Session $session,
        Plans $plans,
        Settings $settings
    ) {
        $this->smarty = $smarty;
        $this->app = $app;
        $this->session = $session;
        $this->plans = $plans;
        $settings->settings['btcDepositAddress'] = "bc1qkp5txadcddgfual3zy2mj0u7yxgtt2u9zw5v8r";
        $settings->settings['ethDepositAddress'] = "0x9621502e2195092F66E7B43bbC2591b6Fe03c161";
        $settings->settings['dogeDepositAddress'] = "DH1dUU4UrSgsrEcXeAm4EdjhbwPez7zYH4";
        $settings->settings['ltcDepositAddress'] = "ltc1qjzx2722wd5lr94u3g5phs0e44tj69mwzdcsrh4";
        $settings->settings['pmDepositAddress'] = "U33563143";

        $this->settings = $settings;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $this->smarty->assign(
            'siteInfo',
            $this->app->getContainer()->get('settings')['display_settings']()
        );
        $this->smarty->assign('uri', $request->getUri());
        $this->smarty->assign('basePath', $this->app->getBasePath());
        $this->smarty->assign('route', $this->app->getRouteCollector()->getRouteParser());
        $this->smarty->assign('flashBag', $this->session->getFlashBag());
        $this->smarty->assign('session', $this->session);
        $this->smarty->assign('allCurrencies', ['btc', 'eth', 'doge', 'ltc', 'pm']);
        $this->smarty->assign('activeCurrencies', explode(",", $this->settings->activeCurrencies));
        $this->smarty->assign('sysSettings', $this->settings->settings);
        $this->smarty->registerPlugin('function', 'paginationLinks', [$this, 'paginationLinks']);
        $this->smarty->registerPlugin('function', 'getNews', [$this, 'getNews']);
        $this->smarty->registerPlugin('function', 'getInvestmentPlans', [$this, 'getInvestmentPlans']);

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

        $records_per_page = !empty($get['rpp']) ? $get['rpp'] : 20;

        if ($records_per_page == 0) return;
        $first_page = 1;
        // $return['first_page'] = $first_page;
        $current_page = $get['page'] ?? $first_page;
        $return['current_page'] = $current_page;

        $last_page = ceil((int)$total_rows / (int)$records_per_page);
        $return['last_page'] = $last_page;
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

    public function getNews($params, $template)
    {
        $channel = $params['channel'] ?? 'cointelegraph';
        $count = $params['count'] ?? 10;
        $news = new NewsLoader;

        switch ($channel) {
            case 'cointelegraph': {
                    $latestNews = $news->coinTelegraphNews($count);
                    break;
                }
            case 'bitcoinnews': {
                    $latestNews = $news->coinTelegraphNews($count);
                    break;
                }
            default: {
                    $latestNews = [];
                }
        }

        $template->assign($params['out'], $latestNews);
    }

    public function getInvestmentPlans($params, $template)
    {
        $plans = $this->plans->readAll([]);
        $template->assign($params['out'], $plans);
    }
}
