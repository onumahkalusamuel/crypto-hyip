<?php

namespace App\Domain\Referrals\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class ReferralsRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;
    private $table = 'referrals';
    private $properties = [
        'ID',
        'referralUserID',
        'referralUserName',
        'referredUserID',
        'referredUserName',
        'referralPaid',
        'referralBonus',
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

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function read(array $params = null): array
    {
        $__ = $this->connection->table($this->table);

        if (!empty($params)) {
            $__->where($params);
        }

        return (array) ['referrals' => $__->get()];
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
