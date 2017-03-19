<?php

define ('ROOT', dirname(__DIR__));
define ('ROOT_APP', ROOT . '/src');

use Dotenv\Dotenv;

//https://github.com/vlucas/phpdotenv

$dotenv = new Dotenv(ROOT);
$dotenv->load();
$dotenv->required(['TIMEZONE'])->notEmpty();
$dotenv->required(['DB_DRIVER', 'DB_HOST', 'DB_USER', 'DB_DATABASE'])->notEmpty();
$dotenv->required(['DB_PASSWORD']);
$dotenv->required(['JOB_SERVERS'])->notEmpty();

date_default_timezone_set(getenv('TIMEZONE'));

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
        'db' => [
            'driver' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'database' => getenv('DB_DATABASE'),
            'debug' => (getenv('DB_DEBUG') ? true : false)
        ],
        'view' => [
            'debug' => (getenv('VIEW_DEBUG') ? true : false),
            #'cache' => ROOT . '/cache',
            'templates' => ROOT . '/templates'
        ],
        // Monolog settings
        'logger' => [
            'name' => 'ecom',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];