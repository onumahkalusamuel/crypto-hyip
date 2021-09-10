<?php

namespace App\Action\Admin\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;

final class ViewAll
{
    protected $plans;
    protected $smarty;

    public function __construct(
        Plans $plans,
        Smarty $smarty
    ) {
        $this->plans = $plans;
        $this->smarty = $smarty;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {

        // plans
        $plans = $this->plans->readAll([]);

        // prepare the return data
        $data = ['plans' => $plans];

	$this->smarty->assign('data', $data);
        $this->smarty->display('admin/plans.tpl');

	return $response;
    }
}
