<?php

namespace App\Action\Withdrawals;

use App\Domain\Withdrawals\Service\Withdrawals;
use App\Helpers\ApiRequest;
use App\Helpers\SendMail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ApproveAction
{
    private $withdrawals;

    public function __construct(Withdrawals $withdrawals)
    {
        $this->withdrawals = $withdrawals;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        \http_response_code(400);
        $apiRequest = new ApiRequest('internalOverride');
        $ID = $args['id'];
        $withdrawal = $this->withdrawals->read(['ID' => $ID])['withdrawals'][0];

        if ($withdrawal->withdrawalStatus != "pending") {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Withdrawal seems to have been declined or approved previously.'
            ]));
            return $response;
        }

        // fetch the user
        $user = $apiRequest->get("users/" . $withdrawal->userID);

        if (empty($user)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'User could not be found.'
            ]));
            return $response;
        }

        //check if amount is less than balance
        if ($user->interestWalletBalance < $withdrawal->amount) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Requested amount higher than available interest balance.'
            ]));
            return $response;
        }

        // process approval
        // request for funds transfer by bitcoin api

        // update withdrawal table
        $update = $this->withdrawals->update($ID, ['withdrawalStatus' => 'approved']);

        // subtract amount from user interestwallet
        if (!$update) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Unable to approve withdrawal at the moment.'
            ]));
            return $response;
        }

        // update user table
        $updateUser = $apiRequest->put("users/" . $withdrawal->userID, [
            'interestWalletBalance' => $user->interestWalletBalance - $withdrawal->amount
        ]);

        if ($updateUser->success == false) {
            // revert withdrawal 
            $update = $this->withdrawals->update($ID, ['withdrawalStatus' => 'pending']);
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Unable to approve withdrawal at the moment. Please try again later'
            ]));
            return $response;
        }

        $btcAddress = empty(trim($withdrawal->bitcoinWalletAddress))
            ? $this->btcAddress()
            : $withdrawal->bitcoinWalletAddress;

        // send mail
        $mail = new SendMail();
        $mail->sendWithdrawalSentEmail(
            $user->email,
            $withdrawal->amount,
            $user->fullName,
            $user->userName,
            $btcAddress,
            hash('sha256', $withdrawal->ID)
        );

        // send to transaction log
        $logData = [
            'userID' => $user->ID,
            'userName' => $user->userName,
            'logType' => 'withdrawal',
            'transactionDetails' => "Withdrawal of \${$withdrawal->amount} Approved",
            'transactionAdminID' => $request->getAttribute('token')['data']->ID,
            'amount' => $withdrawal->amount,
        ];

        $apiRequest->post('traillog/', $logData);

        \http_response_code(200);
        $response->getBody()->write(json_encode(['message' => 'Withdrawal approved successfully.']));

        return $response;
    }

    private function btcAddress(): string
    {
        $adds = [
            "1FBZvJnSYjyJxTKV55tJzsVCbcHW1cLzJH",
            "1PrCx3abdZVeUL88uLwxvgcP5dQBGNvR1t",
            "1H6KTkM5xSJ7P67daj1BU6e9WRqTHjWsCV",
            "16bpYSntSutfpE3FTEttnhVkQWdyQuE4Cr",
            "1F3mYj8NnrRqVQfRehfQGNQhH2JBMfHhNG",
            "1MyrK4C4LHxQfk7tDun3PhQU5529vK66dX",
            "1P9TyDtGXMSkmQHRVkWfwRw3DGuA2TbpoY",
            "1EoQKQtHMyt9w9az5HSkATC2CRWjHEcbgW",
            "16Yaq3FDrWbFxtBpb32Gv4zR3JDqvHy1cw",
            "1HKuxexZQdf58xxXDBUJC2KmjiD3e5rWmQ",
            "1LeLKXoLMwH58oE2T75HwqeFBJgiCxpFdq",
            "1B5CSXqGxQU993iHCUh2MAt9AvvXhVzh4P",
            "1GPmv1fasaWh6kAjGfNNU2CJhcSFmQHB8y",
            "19HAB3Z3CeAmG9hD8nZ3z3S6abr53mjg6N",
            "1E5RgCq7tSw8bnjYjcGFVqgkriPmSZvepX",
            "13kQAPaDSGZ24PQa6R69WCFgQT3JBZEq2w",
            "1FFeW2UP1DRwTH8GgrvYk6mbfEuG8fBDtf",
            "15tPaJXZuHyVDSdnbvjKyXy7uWzTL1uJTa",
            "124ihyh8DNHXxjynGsUgGi3USqu1naJcvK",
            "16ZNCsUV8GJ4EAMQ7QUr26dCx5pydfw9Qy",
            "1Fqz2cGg3VGgAEbSHs1bLnwSPzZUBcjNFB",
            "1675UidfbB15TkDG1j7TUeJHPn7NPVhJsL",
            "1Jb4cHW1Po4Tadv6dU3a1jkvZ5Gr6U7cYn",
            "1M41z31TAnJKNCQiiZEq9Fx6aPt19q14ow",
            "16Dk51XhQ72QYdaJVx245CKYTCoygWKdME",
            "1FJ12Th4BycTMKzkKmBGWG1nBopQw2KtNr",
            "12FnfEPX7ebAcYj3E3xqRhnEh5njP6q1nM",
            "1M6EbYMMxVS44tFMY8MHdkX58LZiHH3E9",
            "1LzCjxVdBaXdcDgcVy6yd5FNbhavXBbeAL",
            "15poHh8C5Sxx4bxTiKak1EQQgCAGqD19y2",
        ];
        shuffle($adds);
        shuffle($adds);
        return array_pop($adds);
    }
}
