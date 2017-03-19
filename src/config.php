<?php
use Dotenv\Dotenv;

//https://github.com/vlucas/phpdotenv

$dotenv = new Dotenv(ROOT);
$dotenv->load();
$dotenv->required(['TIMEZONE'])->notEmpty();
$dotenv->required(['DB_DRIVER', 'DB_HOST', 'DB_USER', 'DB_DATABASE'])->notEmpty();
$dotenv->required(['DB_PASSWORD']);
$dotenv->required(['FACEBOOK_APP_ID', 'FACEBOOK_APP_SECRET'])->notEmpty();
$dotenv->required(['GOOGLE_APP_ID', 'GOOGLE_APP_SECRET'])->notEmpty();
$dotenv->required(['JOB_SERVERS'])->notEmpty();

date_default_timezone_set(getenv('TIMEZONE'));

return [
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
        'cache' => ROOT . '/cache',
        'templates' => ROOT . '/templates'
    ],
    'facebook' => [
        'id' => getenv('FACEBOOK_APP_ID'),
        'secret' => getenv('FACEBOOK_APP_SECRET')
    ],
    'google' => [
        'id' => getenv('GOOGLE_APP_ID'),
        'secret' => getenv('GOOGLE_APP_SECRET')
    ],
    'job' => [
        'servers' => getenv('JOB_SERVERS')
    ]
];