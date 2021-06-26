<?php

namespace App\Domain\Deposits\Service;

use App\Base\Domain\Service;
use App\Domain\Deposits\Repository\DepositsRepository;

class Deposits extends Service
{

    protected $repository;

    public function __construct(DepositsRepository $repository)
    {
        $this->repository = $repository;
    }
}
