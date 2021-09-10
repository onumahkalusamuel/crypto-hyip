<?php

namespace App\Action\Admin\Plans;

use App\Domain\Plans\Service\Plans;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty as View;

final class SingleView
{
    protected $plans;
    protected $view;

    public function __construct(
        Plans $plans,
        View $view
    ) {
        $this->plans = $plans;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ): ResponseInterface {

        $ID = $args['id'];

        if($ID == 'new') {
            $plan = new \stdClass;
            $plan->ID = "new";
        } else {
            $plan = $this->plans->readSingle(['ID' => $ID]);
        }

        // prepare the return data
        $data = ['plan' => $plan];

	$this->view->assign('data', $data);
        $this->view->display('admin/view-plan.tpl');
        return $response;
    }
}
