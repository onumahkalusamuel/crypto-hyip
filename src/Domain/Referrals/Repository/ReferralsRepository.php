<?php

namespace App\Domain\Referrals\Repository;

use App\Base\Domain\Repository;

/**
 * Repository.
 */
class ReferralsRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;
    protected $table = 'referrals';
    protected $properties = [
        'ID',
        'referralUserID',
        'referralUserName',
        'referredUserID',
        'referredUserName',
        'referralPaid',
        'referralBonus',
        'createdAt'
    ];
}
