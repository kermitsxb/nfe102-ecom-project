<?php



$container = $app->getContainer();
// view renderer
//$container['renderer'] = function ($c) {
//    $settings = $c->get('settings');
//    return new Application\View\Twig($settings['view']['templates'], $settings['view']);
//};

$container['view'] = function ($container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['templates'], $settings['view']);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view['baseUrl'] = $container['request']->getUri()->getBaseUrl();
    $user = \Application\Session\Session::getInstance()->get('user');
    if ($user)
    {
        $view['user'] = $user;
    }

    return $view;
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

// Initializing Propel connectino
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('ecom', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$dbsettings = $container->get('settings')['db'];
$manager->setConfiguration([
    'dsn' => 'mysql:host=' . $dbsettings['host'] . ';port=3306;dbname=' . $dbsettings['database'].';charset=utf8',
    'user' => $dbsettings['user'],
    'password' => $dbsettings['password'],
    'settings' =>
        [
            'queries' => [],
        ],
    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
]);
$manager->setName('ecom');
$serviceContainer->setConnectionManager('ecom', $manager);
$serviceContainer->setDefaultDatasource('ecom');

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $c->logger->info("Not Found : " . $request->getUri());
        return $c['response']->withRedirect($c->router->pathFor('404'), 404);
//        return $c['response']
//            ->withStatus(404)
//            ->withHeader('Content-Type', 'text/html')
//            ->write($c['view']->render($response, '404.html'));
//            ->write($c->view->render($response, '404.html'));
//            ->withRedirect($c->router->pathFor('404'));
    };
};


$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $c->logger->info("ERROR HANDLER : " . get_class($exception) . " => " . $exception->getMessage());
        if ($exception instanceof Zend\Permissions\Acl\Exception\InvalidArgumentException)
        {
            return $c['response']->withRedirect($c->router->pathFor('forbidden'), 403);
        }
    };
};