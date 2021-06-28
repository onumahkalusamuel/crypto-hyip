<?php

namespace App\Action\Deposits;

use App\Domain\Deposits\Service\Deposits;
use App\Helpers\ApiRequest;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class CalculateInterestsAction
{
    private $deposits;

    public function __construct(Deposits $deposits)
    {
        $this->deposits = $deposits;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {

        $apiRequest = new ApiRequest('internalOverride');
        //fetch all unpaid deposits
        $params = [
            'depositStatus' => 'approved',
            'interestPaid' => 0,
            'isActive' => 1
        ];

        $deposits = $this->deposits->readDeposit($params)['deposits'];

        //fetch all the plans
        $plans = [];
        $p = $apiRequest->get('plans')->plans;
        foreach ($p as $pp) $plans[$pp->ID] = $pp;

        //calculate interest and credit interestWalletBalance
        foreach ($deposits as $d) {

            if (empty($plans[$d->planID])) continue;

            // check if its time 
            $now = time();
            $dTime = strtotime($d->updatedAt);
            $pInterval = $plans[$d->planID]->duration * 3600;

            if ($now <= ($dTime + $pInterval)) continue;

            //calculate
            $interest = round($plans[$d->planID]->percentage / 100 * $d->amount, 2);
            if (!$interest) continue;

            // update deposits
            $update = $this->deposits->updateDeposit($d->ID, ['interestPaid' => 1, 'isActive' => 0]);
            if (!$update) continue;

            //update the interestWalletBalance
            // get user
            $user = $apiRequest->get('users/' . $d->userID);

            // add to deposit wallet balance
            $update = $apiRequest->put('users/' . $d->userID, [
                'interestWalletBalance' => $user->interestWalletBalance + $interest
            ]);

            if (!$update->success) continue;

            // then log it
            $log = $apiRequest->post('traillog/', [
                'userID' => $user->ID,
                'userName' => $user->userName,
                'logType' => 'earning',
                'transactionDetails' => "Earning from deposit $" . $d->amount . " - " . $plans[$d->planID]->percentage . "%",
                'transactionAdminID' => '0',
                'amount' => $interest,
            ]);
        }

        $response->getBody()->write(json_encode(["success" => true, "message" => "Process completed"]));
        return $response;
    }
}
