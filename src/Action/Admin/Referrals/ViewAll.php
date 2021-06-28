<?php

namespace App\Action\Admin\Referrals;

use App\Domain\Referrals\Service\Referrals;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer as View;

final class ViewAll
{
    protected $referrals;
    protected $view;

    public function __construct(
        Referrals $referrals,
        View $view
    ) {
        $this->referrals = $referrals;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        $filters = $params = [];

        // where
        if(!empty($_GET['referralUserID'])) {
            $params['where']['referralUserID'] = $_GET['referralUserID'];
        }

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
            'filters' => $filters
        ]);

        // prepare the return data
        $data = [
            'referrals' => $referrals
        ];

        return $this->view->render($response, 'admin/referrals.php', ['data' => $data]);
    }
}
