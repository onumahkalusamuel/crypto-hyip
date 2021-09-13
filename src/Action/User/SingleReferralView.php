<?php

namespace App\Action\User;

use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Smarty as View;

final class SingleReferralView
{
    protected $session;
    protected $referrals;
    protected $trailLog;
    protected $view;

    public function __construct(
        Session $session,
        Referrals $referrals,
        TrailLog $trailLog,
        View $view
    ) {
        $this->session = $session;
        $this->referrals = $referrals;
        $this->trailLog = $trailLog;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $userID = $this->session->get('ID');
        $ID = $args['id'];
        $params = [];

        // params
        $params['userID'] = $userID;
        $params['ID'] = $ID;

        // find the deposit
        $referral = $this->referrals->find(['params' => $params]);

        // trailLog of Deposit
        $trailLog = $this->trailLog->readAll([
            'params' => [
                'where' => [
                    'userID' => $userID,
                    'transactionID' => $ID,
                    'logType' => 'referral'
                ]
            ]
        ]);

        // prepare the return data
        $data = [
            'referral' => $referral,
            'trailLog' => $trailLog
        ];

        $this->view->assign('data', $data);
        $this->view->display('theme/user/view-referral.tpl');

        return $response;
    }
}
