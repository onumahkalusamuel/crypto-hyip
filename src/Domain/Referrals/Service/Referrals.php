<?php

namespace App\Domain\Referrals\Service;

use App\Domain\Referrals\Repository\ReferralsRepository;

class Referrals
{

    private $repository;

    public function __construct(ReferralsRepository $repository)
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
