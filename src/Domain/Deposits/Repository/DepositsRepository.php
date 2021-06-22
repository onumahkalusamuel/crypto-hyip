<?php

namespace App\Domain\Deposits\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class DepositsRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    private $table = 'deposits';

    private $properties = [
        'ID',
        'userID',
        'userName',
        'planID',
        'planTitle',
        'interestPaid',
        'transactionID',
        'amount',
        'btcAmount',
        'depositStatus',
        'isActive',
        'createdAt',
        'updatedAt'
    ];
    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function readDeposit(array $params = null): array
    {
        $__rD = $this->connection->table($this->table);

        if (!empty($params)) {
            $__rD->where($params);
        }

        return (array) ['deposits' => $__rD->get()];
    }

    public function createDeposit(array $data): int
    {
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties))
                $row[$key] = $value;

        return $this->connection->table($this->table)->insertGetId($row);
    }

    public function deleteDeposit(array $params): bool
    {
        return (bool) $this->connection->table($this->table)
            ->where($params)
            ->delete();
    }

    public function updateDeposit(int $depositId, array $data): bool
    {
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties) && !in_array($key, ['ID']))
                $row[$key] = $value;

        return $this->connection->table($this->table)
            ->where(['ID' => $depositId])
            ->update($row);
    }

    public function fetchDeposits(array $params = []): array
    {
        $deposits = $this->connection->table($this->table);
        if (!empty($params) && is_array($params)) $deposits->where($params);
        return (array) $deposits->get();
    }

    public function depositList(array $params = null): array
    {
        $__ = $this->connection->table($this->table);


        if (!empty($params['userName'])) {
            $__->where('userName', 'LIKE', '%' . $params['userName'] . '%');
        }

        if (!empty($params['userID'])) {
            $__->where(['userID' => $params['userID']]);
        }

        // order
        $__->orderBy('id', 'DESC');


        // records per page
        if (!empty($params['rpp'])) {
            // offset 
            $__->skip($params['offset']);
            $__->take($params['rpp']);
        }

        return (array) [
            'deposits' =>
            $__->get()
        ];
    }
}
