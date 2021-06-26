<?php

namespace App\Domain\TrailLog\Service;

use App\Base\Domain\Service;
use App\Domain\TrailLog\Repository\TrailLogRepository;

class TrailLog extends Service
{

    protected $repository;

    public function __construct(TrailLogRepository $repository)
    {
        $this->repository = $repository;
    }
}
