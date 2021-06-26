<?php

namespace App\Domain\Plans\Repository;

use App\Base\Domain\Repository;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class PlansRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;
    protected $table = "plans";
    protected $properties = [
        'ID',
        'title',
        'features',
        'ordering',
        'hasBadge',
        'minimum',
        'maximum',
        'percentage',
        'duration',
        'durationType',
        'referralPercentage',
        'profitFrequency',
        'isActive'
    ]; 
}
