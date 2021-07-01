<?php

namespace App\Domain\User\Repository;

use App\Base\Domain\Repository;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class UserRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;

    protected $table = 'users';
    protected $referrals_table = 'referrals';

    protected $properties = [
        'ID',
        'fullName',
        'userName',
        'userType',
        'email',
        'password',
        'btcAddress',
        'btcBalance',
        'ethAddress',
        'ethBalance',
        'dogeAddress',
        'dogeBalance',
        'ltcAddress',
        'ltcBalance',
        'token',
        'secretQuestion',
        'secretAnswer',
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
