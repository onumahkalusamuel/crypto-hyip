<?php

namespace App\Domain\Plans\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class PlansRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;
    private $table = "plans";
    private $properties = [
        'ID',
        'title',
        'description',
        'icon',
        'features',
        'ordering',
        'hasBadge',
        'minimum',
        'maximum',
        'percentage',
        'duration',
        'isActive'
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

        if (!empty($params)) {
            $__->where($params);
        }

        return (array) ['plans' => $__->get()];
    }

    public function create(array $data = null): int
    {
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties))
                $row[$key] = $value;

        return $this->connection->table($this->table)->insertGetId($row);
    }

    public function update(int $ID, array $data = null): bool
    {
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties) && !in_array($key, ['ID']))
                $row[$key] = $value;

        return $this->connection->table($this->table)
            ->where(['ID' => $ID])
            ->update($row);
    }

    public function delete(array $params): bool
    {
        return (bool) $this->connection->table($this->table)
            ->where($params)
            ->delete();
    }
}
