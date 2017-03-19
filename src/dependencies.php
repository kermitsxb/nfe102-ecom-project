<?php

$container = $app->getContainer();
// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings');
    return new Application\View\Twig($settings['view']['templates'], $settings['view']);
};
// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['authAdapter'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $conn = 'mysql:dbname=' . $settings['database'] . ";host=" . $settings['host'];
    $db = new \PDO($conn, $settings['user'], $settings['password']);
    $adapter = new \JeremyKendall\Slim\Auth\Adapter\Db\PdoAdapter(
            $db,
            "user",
            "email",
            "password",
            new \JeremyKendall\Password\PasswordValidator()
    );

    return $adapter;
};

$container['acl'] = function ($c) {
    return new Application\Permission\Acl();
};

$container->register(new \JeremyKendall\Slim\Auth\ServiceProvider\SlimAuthProvider());