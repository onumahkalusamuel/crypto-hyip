<?php

namespace App\Domain\Settings\Repository;

use App\Base\Domain\Repository;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class SettingsRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;
    protected $table = 'settings';
    protected $properties = [
        'setting',
        'value'
    ];

    protected $CHILD_DEFAULTS = [
        'order_by' => 'setting'
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

    public function update(array $props): bool
    {
        [ 'setting'=> $setting, 'value' => $value ] = $props;

        return $this->connection->table($this->table)
            ->where(['setting' => $setting])
            ->update(['value' => $value]);
    }
}
