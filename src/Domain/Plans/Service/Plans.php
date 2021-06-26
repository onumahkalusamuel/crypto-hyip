<?php

namespace App\Domain\Plans\Service;

use App\Base\Domain\Service;
use App\Domain\Plans\Repository\PlansRepository;

/**
 * Service.
 */
final class Plans extends Service
{
    /**
     * @var PlansRepository
     */
    protected $repository;

    /**
     * The constructor.
     *
     * @param PlansRepository $repository The repository
     */
    public function __construct(PlansRepository $repository)
    {
        $this->repository = $repository;
    }

}
