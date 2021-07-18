<?php

namespace App\Base\Domain;

use Illuminate\Database\Connection;

class Repository
{
    protected $connection;

    /**
     * table
     *
     * @var string
     */
    protected $table = '';

    /**
     * properties
     *
     * @var array
     */
    protected $properties = [];

    private const DEFAULTS = [
        'select' => '*',
        'data' => [],
        'filters' => [],
        'params' => [],
        'order_by' => 'ID',
        'order' => 'ASC'
    ];

    // defaults from child
    protected $CHILD_DEFAULTS = [];

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    public function commit(): void
    {
        $this->connection->commit();
    }

    public function rollback(): void
    {
        $this->connection->rollback();
    }

    /**
     * readSingle
     *
     * @param $props
     * @return object
     */
    public function readSingle(array $props): object
    {
        [
            'ID' => $id,
            'select' => $select
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        $__ = $this->connection->table($this->table);

        if (!empty($select)) $__->select($select);

        return (object) $__->find($id);
    }

    /**
     * readPaging
     *
     * @param $props
     * @return array
     */
    public function readPaging(array $props): array
    {
        [
            'params' => $params,
            'filters' => $filters,
            'select' => $select,
            'order_by' => $order_by,
            'order' => $order
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        $return = ['data' => [], 'total_rows' => 0];

        $__ = $this->connection
            ->table($this->table);

        if (!empty($select)) $__->select($select);

        // where like
        if (!empty($params['like'])) {

            $__->where(function ($q) use ($params) {

                $x = 0;

                foreach ($params['like'] as $key => $value) {

                    if ($x == 0) $q->where($key, 'LIKE', '%' . $value . '%');
                    else $q->orWhere($key, 'LIKE', '%' . $value . '%');

                    $x++;
                }
            });
        }

        // fix for date ranges - from
        if (!empty($params['where']['from'])) {
            $__->where('createdAt', '>=', $params['where']['from']);
        }

        // fix for date ranges - to
        if (!empty($params['where']['to'])) {
            $__->where('createdAt', '<=', $params['where']['to']);
        }
        // unset from and to
        unset($params['where']['from']);
        unset($params['where']['to']);

        // where direct - the rest
        if (!empty($params['where'])) {
            $__->where($params['where']);
        }

        // get the count first
        $return['total_rows'] = $__->get()->count();

        // then continue
        // order
        $order_by = $filters['sort_by'] && in_array($filters['sort_by'], $this->properties)
            ? $filters['sort_by']
            : $order_by;
        $order = $filters['desc'] ? 'DESC' : $order;

        $__->orderBy($order_by, $order);

        // records per page
        if (!empty($filters['rpp'])) {
            // offset
            $__->skip($filters['offset']);
            $__->take($filters['rpp']);
        }

        $return['data'] = $__->get()->all();

        // finally return
        return $return;
    }

    /**
     * readAll
     *
     * @param $props
     * @return array
     */
    public function readAll(array $props): array
    {

        [
            'params' => $params,
            'select' => $select,
            'order_by' => $order_by,
            'order' => $order,
            'group_by' => $group_by,
            'select_raw' => $select_raw
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        $__ = $this->connection->table($this->table);

        // select
        if (!empty($select)) $__->select($select);

        // select raw
        if (!empty($select_raw)) $__->selectRaw(implode(',', $select_raw));

        // where like
        if (!empty($params['like'])) {

            $__->where(function ($q) use ($params) {

                $x = 0;

                foreach ($params['like'] as $key => $value) {
                    // check for multiple entries in one, separated by pipe (|)
                    $values = explode("|", $value);
                    foreach ($values as $v) {
                        if ($x == 0) $q->where($key, 'LIKE', '%' . $v . '%');
                        else $q->orWhere($key, 'LIKE', '%' . $v . '%');
                        $x++;
                    }
                }
            });
        }

        // where direct
        if (!empty($params['where'])) {
            $__->where($params['where']);
        }

        //grouping
        if (!empty($group_by)) $__->groupBy($group_by);

        // ordering
        $__->orderBy($order_by, $order);

        return (array)$__->get()->all();
    }

    /**
     * find
     *
     * @param array $props
     * @return object
     */
    public function find(array $props): object
    {
        [
            'params' => $params,
            'select' => $select
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        foreach ($params as $key => $value) {
            if (!in_array($key, $this->properties)) {
                unset($params[$key]);
            }
        }
        $__ = $this->connection->table($this->table);

        // select
        if (!empty($select)) $__->select($select);

        // where
        $__->where($params);

        $return = (object) $__->get()->first();

        return $return;
    }

    /**
     * create
     *
     * @param array $props
     * @return int
     */
    public function create(array $props): string
    {

        [
            'data' => $data,
            'id' => $id_override
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties) && !in_array($key, ['id']))
                $row[$key] = $value;

        // override default ID
        if ($id_override) $row['id'] = $id_override;

        try {
            return $this->connection->table($this->table)->insertGetId($row);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * delete
     *
     * @param array $props
     * @return bool
     */
    public function delete(array $props): bool
    {
        [
            'ID' => $ID
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        $__ = $this->connection->table($this->table)
            ->where(['ID' => $ID]);

        return $__->delete();
    }

    /**
     * update
     *
     * @param array $props
     * @return bool
     */
    public function update(array $props): bool
    {

        [
            'data' => $data,
            'ID' => $ID,
            'params' => $params
        ] = $props + $this->CHILD_DEFAULTS + self::DEFAULTS;

        // at least one must be provided
        if (empty($ID) && empty($params)) return false;

        // prepare the update data
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties) && !in_array($key, ['ID']))
                $row[$key] = $value;

        if (empty($row)) return false;

        $__ = $this->connection->table($this->table);
        // attach id
        if (!empty($ID)) $__->where(['ID' => $ID]);
        // attach other params
        if (!empty($params)) $__->where($params);

        // execute update query on $row
        $__->update($row);

        return true;
    }
}
