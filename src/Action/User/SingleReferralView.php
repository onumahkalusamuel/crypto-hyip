<?php

namespace App\Action\User;

use App\Domain\Referrals\Service\Referrals;
use App\Domain\TrailLog\Service\TrailLog;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SingleReferralView
{
    protected $referrals;
    protected $trailLog;

    public function __construct(
        Referrals $referrals,
        TrailLog $trailLog
    ) {
        $this->referrals = $referrals;
        $this->trailLog = $trailLog;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $userID = $request->getAttribute('token')['data']->ID;
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

        $response->getBody()->write(json_encode([
            'success' => true,
            'data' => $data
        ]));

        return $response;
    }
}
