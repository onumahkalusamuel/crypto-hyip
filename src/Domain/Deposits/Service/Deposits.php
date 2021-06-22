<?php

namespace App\Domain\Deposits\Service;

use App\Domain\Deposits\Repository\DepositsRepository;

class Deposits
{

    private $repository;

    public function __construct(DepositsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function readDeposit(array $params = null): array
    {
        return (array) $this->repository->readDeposit($params);
    }

    public function createDeposit(array $data): int
    {
        $depositId = $this->repository->createDeposit($data);

        // log

        return $depositId;
    }

    public function deleteDeposit(array $params): bool
    {
        return $this->repository->deleteDeposit($params);
    }

    public function updateDeposit(int $depositId, array $data): bool
    {
        return $this->repository->updateDeposit($depositId, $data);
    }

    public function fetchDepositsByUser(int $userId): array
    {
        return $this->repository->fetchDeposits(['userId' => $userId]);
    }

    public function depositList($params)
    {

        if (!empty($params['rpp'])) {
            $params['page'] = $params['page'] ?? 1;
            $params['offset'] = ($params['page'] - 1) * $params['rpp'];
        } else {
            $params['rpp'] = 0;
            $params['page'] = 1;
            $params['offset'] = 0;
        }
        return $this->repository->depositList($params);
    }
}
