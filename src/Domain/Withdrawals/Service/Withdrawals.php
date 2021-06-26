<?php

namespace App\Domain\Withdrawals\Service;

use App\Base\Domain\Service;
use App\Domain\Withdrawals\Repository\WithdrawalsRepository;

class Withdrawals extends Service
{

    protected $repository;

    public function __construct(WithdrawalsRepository $repository)
    {
        $this->repository = $repository;
    }
}
