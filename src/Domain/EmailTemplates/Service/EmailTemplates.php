<?php

namespace App\Domain\EmailTemplates\Service;

use App\Base\Domain\Service;
use App\Domain\EmailTemplates\Repository\EmailTemplatesRepository;

/**
 * Service.
 */
final class EmailTemplates extends Service
{
    /**
     * @var EmailTemplatesRepository
     */
    protected $repository;

    /**
     * The constructor.
     *
     * @param EmailTemplatesRepository $repository The repository
     */
    public function __construct(EmailTemplatesRepository $repository)
    {
        $this->repository = $repository;
    }

}
