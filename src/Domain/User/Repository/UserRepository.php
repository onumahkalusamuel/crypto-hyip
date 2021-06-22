<?php

namespace App\Domain\User\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    private $table = 'users';
    private $referrals_table = 'referrals';

    private $properties = [
        'ID',
        'fullName',
        'userName',
        'userType',
        'email',
        'password',
        'bitcoinWalletAddress',
        'interestWalletBalance',
        'depositWalletBalance',
        'token',
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

    public function readUser(int $userId = null): array
    {
        if ($userId)
            return (array)
            $this->connection
                ->table($this->table)
                ->select([
                    'ID',
                    'fullName',
                    'userName',
                    'userType',
                    'email',
                    'bitcoinWalletAddress',
                    'interestWalletBalance',
                    'depositWalletBalance',
                    'isActive',
                    'createdAt',
                    'updatedAt'
                ])
                ->where('userType', 'user')
                ->find($userId);
        else
            return (array)
            ['users' =>
            $this->connection
                ->table($this->table)
                ->select([
                    'ID',
                    'fullName',
                    'userName'
                ])
                ->where('userType', 'user')
                ->get()];
    }

    public function findUser(array $params): array
    {
        return (array) $this->connection->table($this->table)->where($params)->first();
    }
    public function usersList(int $offset, int $rowsperpage, string $userName): array
    {
        return ['users' =>
        $this->connection
            ->table($this->table)
            ->leftJoin(
                $this->referrals_table,
                $this->table . '.ID',
                $this->referrals_table . '.referredUserID'
            )
            ->select([
                $this->table . '.ID',
                $this->table . '.fullName',
                $this->table . '.userName',
                $this->table . '.email',
                $this->table . '.bitcoinWalletAddress',
                $this->table . '.interestWalletBalance',
                $this->table . '.isActive',
                $this->table . '.createdAt',
                $this->referrals_table . '.referralUserName'
            ])
            ->skip($offset)
            ->take($rowsperpage)
            ->where(['userType' => "user"])
            ->where('userName', 'LIKE', "%$userName%")
            ->orderBy('id', 'DESC')
            ->get()];
    }

    public function insertUser(array $user): int
    {
        $row = [];
        foreach ($user as $key => $value)
            if (in_array($key, $this->properties))
                $row[$key] = $value;

        return $this->connection->table($this->table)->insertGetId($row);
    }

    public function deleteUser(int $userId): bool
    {
        return $this->connection->table($this->table)
            ->where(['ID' => $userId])
            ->delete();
    }

    public function updateUser(int $userId, array $data): bool
    {
        $row = [];
        foreach ($data as $key => $value)
            if (in_array($key, $this->properties) && !in_array($key, ['ID']))
                $row[$key] = $value;

        return $this->connection->table($this->table)
            ->where(['ID' => $userId])
            ->update($row);
    }

    public function emailInUse(string $email): bool
    {
        return (bool) $this->connection->table($this->table)->where(['email' => $email])->count();
    }

    public function usernameInUse(string $userName): bool
    {
        return (bool) $this->connection->table($this->table)->where(['userName' => $userName])->count();
    }

    public function loginUser(string $userName): array
    {
        return (array) $this->connection
            ->table($this->table)
            ->where(['userName' => $userName, 'isActive' => 1])->first();
    }
}
