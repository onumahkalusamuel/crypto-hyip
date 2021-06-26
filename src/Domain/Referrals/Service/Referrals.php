<?php

namespace App\Domain\Referrals\Service;

use App\Base\Domain\Service;
use App\Domain\Referrals\Repository\ReferralsRepository;

class Referrals extends Service
{

    protected $repository;

    public function __construct(ReferralsRepository $repository)
    {
        $this->repository = $repository;
    }
}
