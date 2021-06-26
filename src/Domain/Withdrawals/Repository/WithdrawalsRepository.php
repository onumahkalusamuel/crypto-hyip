<?php

namespace App\Domain\Withdrawals\Repository;

use App\Base\Domain\Repository;

/**
 * Repository.
 */
class WithdrawalsRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;
    protected $table = 'withdrawals';
    protected $properties = [
        'ID',
        'userID',
        'userName',
        'amount',
        'cryptoCurrency',
        'withdrawalAddress',
        'withdrawalStatus',
        'messageFromUser',
        'messageFromAdmin',
        'createdAt',
        'updatedAt'
    ];

    protected $CHILD_DEFAULTS = [
        'order' => 'DESC',
        'order_by' => 'ID'
    ];
}
