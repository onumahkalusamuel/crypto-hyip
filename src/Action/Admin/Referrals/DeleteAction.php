<?php

namespace App\Action\Referrals;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DeleteAction
{
    private $referrals;

    public function __construct(Referrals $referrals)
    {
        $this->referrals = $referrals;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $auth = $request->getAttribute("token")['data'];

        if (empty($args['id'])) {
        }

        if ($auth->userType != "admin") {

            \http_response_code(403);

            return $response;
        }

        $params['ID'] = $args['id'];

        $params['referralUserID'] = $args['referral_user_id'];

        if ($this->referrals->delete($params)) {

            $response->getBody()->write((string)json_encode(['message' => 'Referral deleted.']));
        } else {

            \http_response_code(404);
        }

        return $response;
    }
}
