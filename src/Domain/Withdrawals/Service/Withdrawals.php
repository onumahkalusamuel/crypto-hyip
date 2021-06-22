<?php

namespace App\Domain\Withdrawals\Service;

use App\Domain\Withdrawals\Repository\WithdrawalsRepository;

class Withdrawals
{

    private $repository;

    public function __construct(WithdrawalsRepository $repository)
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
