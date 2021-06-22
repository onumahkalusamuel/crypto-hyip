<?php

namespace App\Domain\Plans\Service;

use App\Domain\Plans\Repository\PlansRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class Plans
{
    /**
     * @var PlansRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PlansRepository $repository The repository
     */
    public function __construct(PlansRepository $repository)
    {
        $this->repository = $repository;
    }

    public function read(array $params = null): array
    {
        return (array) $this->repository->read($params);
    }

    public function create(array $data): int
    {
        $ID = $this->repository->create($data);

        // log

        return $ID;
    }

    public function delete(array $params): bool
    {
        return $this->repository->delete($params);
    }

    public function update(int $ID, array $data): bool
    {
        return $this->repository->update($ID, $data);
    }
}
