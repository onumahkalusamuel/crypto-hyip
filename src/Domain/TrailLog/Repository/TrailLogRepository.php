<?php

namespace App\Domain\TrailLog\Repository;

use App\Base\Domain\Repository;

/**
 * Repository.
 */
class TrailLogRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;
    protected $table = 'traillog';
    protected $properties = [
        'ID',
        'userID',
        'userName',
        'logType',
        'transactionID',
        'transactionDetails',
        'cryptoCurrency',
        'amount',
        'createdAt'
    ];

    protected const DEFAULTS = [
        'select' => '*',
        'data' => [],
        'filters' => [],
        'params' => [],
        'order_by' => 'createdAt',
        'order' => 'DESC'
    ];


    public function readPaging(array $props): array
    {
        $return = ['data' => [], 'total_rows' => 0];

        [
            'params' => $params,
            'filters' => $filters,
            'order_by' => $order_by,
            'order' => $order
        ] = $props + self::DEFAULTS;

        [ 'where' => $where ] = $params;

        $__ = $this->connection->table($this->table);

        if (!empty($where['from'])) {
            $__->where('createdAt', '>=', $where['from']);
        }

        if (!empty($where['to'])) {
            $__->where('createdAt', '<=', $where['to']);
        }

        if (!empty($where['logType']) && $where['logType'] !== "all") {
            $__->where('logType', $where['logType']);
        }

        if (!empty($where['userID'])) {
            $__->where('userID', $where['userID']);
        }

        // get count
        $return['total_rows'] = $__->get()->count();

        // order
        $__->orderBy($order_by, $order);

        // records per page
        if (!empty($filters['rpp'])) {
            // offset 
            $__->skip($filters['offset']);
            $__->take($filters['rpp']);
        }

        $return['data'] = $__->get()->all();

        return $return;
    }
}
