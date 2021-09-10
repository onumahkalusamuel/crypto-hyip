<?php

namespace App\Action\Admin\Referrals;

use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class SingleView
{
    protected $referrals;
    protected $trailLog;
    protected $view;

    public function __construct(
        Referrals $referrals,
        TrailLog $trailLog,
        View $view
    ) {
        $this->referrals = $referrals;
        $this->trailLog = $trailLog;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];
        
        // find the deposit
        $referral = $this->referrals->readSingle(['ID' => $ID]);

        // trailLog of Deposit
        $trailLog = $this->trailLog->readAll([
            'params' => [
                'where' => [
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
        $this->view->display('admin/view-referral.tpl');

        return $response;
    }
}
