<?php

namespace App\Action\Referrals;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RefDashboardAction
{
    private $referrals;

    public function __construct(Referrals $referrals)
    {
        $this->referrals = $referrals;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {
        // Collect args
        $auth = $request->getAttribute("token")['data'];

        // referrals
        if ($auth->userType == "admin" && !empty($_GET['userID'])) {
            $ID = $_GET['userID'];
        } else {
            $ID = $auth->ID;
        }

        $referrals = $this->referrals->read(['referralUserID' => $ID]);

        $return['referrals'] = $referrals['referrals'];

        // $response->getBody()->write(json_encode([$referrals, $ID, $_GET, $auth]));
        // return $response;
        $overview = $this->generateOverview($referrals['referrals']);

        $return['overview'] = [
            [
                'title' => 'Total Referrals',
                'body' =>  $overview['totalReferrals'],
                'type' => 'number'
            ],
            [
                'title' => 'Total Referral Commission',
                'body' => $overview['totalReferralCommission'],
                'type' => 'currency'
            ]
        ];

        $response->getBody()->write(json_encode($return));

        return $response;
    }

    public function generateOverview($referrals = []): array
    {
        $return = [
            'totalReferrals' => 0,
            'totalReferralCommission' => 0
        ];

        if (!empty($referrals)) {
            foreach ($referrals as $ref) {
                // increment total refs 
                $return['totalReferrals']++;

                // calculate income 
                $return['totalReferralCommission'] += $ref->referralBonus;
            }
        }

        // attach the currency
        $return['totalReferralCommission'] = $return['totalReferralCommission'];
        return (array) $return;
    }
}
