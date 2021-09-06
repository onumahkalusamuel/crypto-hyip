<?php

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Africa/Lagos');

// Settings
$settings = [];

// environment
$env = "dev"; // dev | prod

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['upload_dir'] = $settings['public'] . '/uploads';
$settings['view']['path'] = __DIR__ . '/../templates/default/';

// Error Handling Middleware settings
$settings['error'] = [
    // Should be set to false in production
    'display_error_details' => (bool) $env === "dev",
    'log_errors' => true,
    'log_error_details' => true,
];

// database connection
if ($env === 'prod') {
    $database = 'bitrziax_btc';
    $username = 'bitrziax_btc';
    $password = '8p[PlwbX0~7}';
} else {
    $database = 'btc';
    $username = 'root';
    $password = 'root';
}

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => $username,
    'database' => $database,
    'password' => $password,
    'charset' => 'utf8mb4',
    'port' => 3306,
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

// email settings
$settings['smtp'] = [
    'email' => 'admin@bitrivetrading.com',
    'password' => '5(;-0EYEu6aL',
    'name' => 'Bitrive Admin',
    'host' => gethostname()
];

// Session
$settings['session'] = [
    'name' => 'webapp',
    'cache_expire' => 0,
];

// fetch the definitions from the public file
$settings['display_settings'] = function () {
    return require __DIR__ . "/../___settings.php";
};

return $settings;
