<?php

namespace App\Domain\TrailLog\Service;

use App\Domain\TrailLog\Repository\TrailLogRepository;

class TrailLog
{

    private $repository;

    public function __construct(TrailLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function read(array $params = null): array
    {
        if (!empty($params['rpp'])) {
            $params['page'] = $params['page'] ?? 1;
            $params['offset'] = ($params['page'] - 1) * $params['rpp'];
        } else {
            $params['rpp'] = 0;
            $params['page'] = 1;
            $params['offset'] = 0;
        }

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
}
