<?php

namespace App\Domain\TrailLog\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class TrailLogRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;
    private $table = 'traillog';
    private $properties = [
        'ID',
        'userID',
        'userName',
        'logType',
        'transactionAdminID',
        'transactionDetails',
        'amount',
        'createdAt'
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

    public function read(array $params = null): array
    {
        $__ = $this->connection->table($this->table);

        if (!empty($params['from'])) {
            $__->where('createdAt', '>=', $params['from']);
        }

        if (!empty($params['to'])) {
            $__->where('createdAt', '<=', $params['to']);
        }

        if (!empty($params['type']) && $params['type'] != "all") {
            $__->where(['logType' => $params['type']]);
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
            'traillog' =>
            $__->get()
        ];
    }

    public function create(array $data = null): int
    {
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties))
                $row[$key] = $value;

        return $this->connection->table($this->table)->insertGetId($row);
    }


    public function delete(array $params): bool
    {
        return (bool) $this->connection->table($this->table)
            ->where($params)
            ->delete();
    }
}
