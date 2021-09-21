<?php

namespace App\Action\User;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class ReferralsView
{
    protected $session;
    protected $referrals;
    protected $view;

    public function __construct(
        Session $session,
        Referrals $referrals,
        View $view
    ) {
        $this->session = $session;
        $this->referrals = $referrals;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $ID = $this->session->get('ID');

        $filters = $params = [];

        // where
        $params['where']['referralUserID'] = $ID;
        $params['where']['to'] = $_GET['to'] ?? '';
        $params['where']['from'] = $_GET['from'] ?? '';

        if (!empty($_GET['query'])) {
            $params['like']['referredUserName'] =  $_GET['query'];
            $params['like']['referralUserName'] =  $_GET['query'];
        }

        // paging
        $filters['page'] = !empty($_GET['page']) ? $_GET['page'] : 1;
        $filters['rpp'] = isset($_GET['rpp']) ? (int) $_GET['rpp'] : 20;

        // referrals
        $referrals = $this->referrals->readPaging([
            'params' => $params,
            'filters' => $filters,
            'select' => [
                'ID',
                'referralUserName',
                'referredUserID',
                'referredUserName',
                'referralBonus',
                'createdAt'
            ]
        ]);

        // generate referral link
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $referral_link = $routeParser->fullUrlFor(
            $request->getUri(),
            "ref",
            ['referralUserName' => $this->session->get('userName') ?? 'admin']
        );

        // get the count and commissions earned totals
        $refs = $this->referrals->readAll([
            'select_raw' => [
                'COUNT(*) as total_referrals',
                'SUM(referralBonus) as total_referral_commission'
            ],
            'select' => ['referralUserID'],
            'group_by' => 'referralUserID',
            'order_by' => 'referralUserID',
            'params' => [
                'where' => [
                    'referralUserID' => $ID
                ]
            ]
        ]);

        if (!empty($refs)) {
            $r = $refs[0];
        }

        // prepare the return data
        $data = [
            'referrals' => $referrals,
            'referral_link' => $referral_link,
            'referral_overview' => [
                'total_referrals' => (int) $r->total_referrals,
                'total_referral_commission' => (float) $r->total_referral_commission
            ],
        ];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/referrals.tpl');

        return $response;
    }
}
