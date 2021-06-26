<?php

namespace App\Domain\Deposits\Repository;

use App\Base\Domain\Repository;

/**
 * Repository.
 */
class DepositsRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;

    protected $table = 'deposits';

    protected $properties = [
        'ID',
        'userID',
        'userName',
        'planID',
        'planTitle',
        'percentage',
        'profitFrequency',
        'transactionID',
        'amount',
        'cryptoCurrency',
        'cryptoAmount',
        'depositAddress',
        'depositStatus',
        'depositApprovalDate',
        'interestBalance',
        'lastInterestDate',
        'finalInterestDate',
        'createdAt',
        'updatedAt'
    ];

    protected $CHILD_DEFAULTS = [
        'order' => 'DESC',
        'order_by' => 'ID'
    ];
}
