<?php

namespace App\Base;

use Illuminate\Database\Connection;
use Psr\Container\ContainerInterface;

class CronJob
{
    // table
    public $table = 'queued_jobs';
    const DEFAULT_PARAMS = [
        'limit' => 20,
        'type' => 'mail'
    ];

    /**
     * First DB connection
     *
     * @var Illuminate\Database\Connection;
     */
    public $connection;

    public function __construct(ContainerInterface $container)
    {
        // $this->settings =  require_once __DIR__ . '/../config/settings.php';
        $this->settings = $container->get('settings');
        //connection        
        $this->connection = $container->get(Connection::class);
    }

    public function process(): bool { return true; }

    public function update($id, $data = []): bool
    {
        return (bool) $this->connection->table($this->table)->where(['id' => $id])->update($data);
    }
}
