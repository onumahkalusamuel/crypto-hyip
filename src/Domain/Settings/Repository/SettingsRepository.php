<?php

namespace App\Domain\Settings\Repository;

use Illuminate\Database\Connection;

/**
 * Repository.
 */
class SettingsRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;
    private $table = 'settings';
    private $properties = [
        'setting',
        'value'
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

    public function read(string $setting = null): array
    {
        $__ = $this->connection->table($this->table);

        if (!empty($setting)) {
            $__->where(['setting' => $setting]);
        }

        return (array) ['settings' => $__->get()];
    }

    public function update(string $setting, string $value = null): bool
    {
        return $this->connection->table($this->table)
            ->where(['setting' => $setting])
            ->update(['value' => $value]);
    }
}
