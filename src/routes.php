<?php
use Application\Session\Session;

/** @var Slim\Http\Request  $request */
/** @var User  $user */

// Routes

$data                 = array();
$data['base_url']     = 'https://localhost/';
//$data['current_url']  = $data['base_url'].trim($app->getContainer('request')->getUri(), '/');
$data['mainmenu']     = array(
    array(
        'title' => 'Accueil',
        'url'	  => $data['base_url']
    ),
    array(
        'title' => 'Tomates',
        'url'	  => $data['base_url'] . 'variete/tomates/'
    ),
    array(
        'title' => 'Aromatique',
        'url'	  => $data['base_url'] . 'variete/aromatique/'
    ),
);

$app->get('/', function ($request, $response, $args) use ($data) {
    // Sample log message
    $this->logger->info("GET '/' route");
    // Render index view

//    return $this->renderer->render('index.html', $args);
    return $this->view->render($response, 'index.html', $args);
})->setName('index');

$app->group('/variete', function () use ($data) {
    $this->get('/tomates', function ($request, $response, $args) use ($data) {
        // Sample log message
        $this->logger->info("'/variete/tomates' route");
        // Render index view
        $query = new ProductQuery();
        $tomates = $query->findByProductShelfId(1);

        $args['products'] = $tomates;

        return $this->view->render($response, 'shelf.html', $args);
    })->setName('tomates');

    $this->get('/aromatiques', function ($request, $response, $args) use ($data) {
        // Sample log message
        $this->logger->info("'/variete/aromatiques' route");
        // Render index view

//    return $this->renderer->render('index.html', $args);
        return $this->view->render($response, 'shelf.html', $args);
    })->setName('aromatiques');
});

/*
 *  GET /login
 */
$app->get('/login', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("GET '/login' route");
    $args['context'] = 'login';

    $user = Session::getInstance()->get('user');
    if ($user){
        $this->logger->info("User logged, redirect to Url  : " . $this->router->pathFor('userIndex', array('id' => $user->getId())));

        return $response->withRedirect($this->router->pathFor('userIndex', array('id' => $user->getId())), 303);
    }

    $message = Session::getInstance()->get('message');
    if ($message){
        foreach ($message as $mes){
            $args['messages'][] = $mes;
        }

        Session::getInstance()->delete('message');
    }


    // Render index view
    return $this->view->render($response, 'login.html', $args);
})->setName('login');
/*
 *  GET /logout
 */
$app->get('/logout', function ($request, $response, $args){
    $this->logger->info("GET '/user/logout' route");

    $this->authenticator->logout();
    Session::getInstance()->destroy();
    return $response->withRedirect($this->router->pathFor('index'),303);
})->setName('logout');

/*
 *  POST /login/register
 */
$app->post('/register', function($request, $response, $args){
    // Sample log message
    $this->logger->info("POST '/register' route");
    $args['context'] = 'register';

    $username = null;

    if ($request->isPost()) {
        $username = strtolower($request->getParam('email'));

        $userQuery = new UserQuery();
        $user = $userQuery->findOneByEmail($username);

        if ($user === null)
        {
            $password = $request->getParam('password');
            $passwordConf = $request->getParam('passwordConf');

            $this->logger->info("User : " . $username);
            $this->logger->info("Password : " . $password);
            $this->logger->info("PasswordConf : " . $passwordConf);

            if ($password === $passwordConf) {
                $roles = "member";
                $creation = date("Y-m-d H:i:s");
                $modification = date("Y-m-d H:i:s");

                $queryId = new UserQuery();
                $lastUser = $queryId->orderById('desc')->findOne();
                if ($lastUser) {
                    $userId = $lastUser->getId() + 1;
                } else {
                    $userId = 0;
                }

                $user = new User();
                $user->setId($userId);
                $user->setEmail($username);
                $user->setFirstname($request->getParam('prenom'));
                $user->setLastname($request->getParam('nom'));
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $user->setCreationDate($creation);
                $user->setModificationDate($modification);
                $user->setRole($roles);
                $user->save();

                $result = $this->authenticator->authenticate($username, $password);
                if ($result->isValid()) {
                    Session::getInstance()->set('user', $user);
                }

                $this->logger->info("Url  : " . $this->router->pathFor('userIndex', array('id' => $user->getId())));

                return $response->withRedirect($this->router->pathFor('userIndex', array('id' => $user->getId())));
            } else {
                $message = Session::getInstance()->get('message');
                if (!$message)
                {
                    $message = array();
                }
                $message[] = "Les mots de passes sont différents";

                $this->logger->info($message);

                Session::getInstance()->set('message', $message);
                return $response->withRedirect($this->router->pathFor('login'));
            }
        } else {
            $message = Session::getInstance()->get('message');
            if (!$message)
            {
                $message = array();
            }
            $message[] = "Utilisateur existant !";

            $this->logger->info($message);

            Session::getInstance()->set('message', $message);
            return $response->withRedirect($this->router->pathFor('login'));
        }
    }

    // Render index view
    return $this->view->render($response, 'login.html', $args);
})->setName('register');

$app->post('/login', function($request, $response, $args) use ($app){
    // Sample log message
    $this->logger->info("POST '/login' route");
    $args['context'] = 'login';

    $username = null;

    if ($request->isPost()) {
        $username = $request->getParam('email');
        $password = $request->getParam('password');

        $this->logger->info("User : " . $username);
        $this->logger->info("Password : " . $password);

        $result = $this->authenticator->authenticate($username, $password);

        if ($result->isValid()) {
            $query = new UserQuery();
            $user = $query->filterByEmail($username)->findOne();
            $user->initCart();
            Session::getInstance()->set('user', $user);

            return $response->withRedirect($this->router->pathFor('userIndex', array('id' => $user->getId())), 303);
        } else {
            $args['messages'] = $result->getMessages();
        }
    }

    // Render index view
    return $this->view->render($response, 'login.html', $args);
})->setName('loginPost');

$app->group('/user', function () use ($app) {

    $this->get('/', function ($request, $response, $args) {
        $this->logger->info("GET '/user' route");
        $args['context'] = 'account';

        $user = Session::getInstance()->get('user');

            $this->logger->info('User "'.$user->getId(). " - " . $user->getFirstname() . " " . $user->getLastname() .'" logged !');
            return $this->view->render($response, 'user/index.html', $args);
    })->setName('userIndex');

    $this->post('/', function ($request, $response, $args) {
        $this->logger->info("GET '/user' route");
        $args['context'] = 'account';

        $user = Session::getInstance()->get('user');

        $this->logger->info('User "'.$user->getId(). " - " . $user->getFirstname() . " " . $user->getLastname() .'" logged !');
        return $this->view->render($response, 'user/index.html', $args);
    })->setName('userIndex');

    $this->get('/address', function ($request, $response, $args) {
        $this->logger->info("GET '/user/address' route");
        $args['context'] = 'account';

        $user = Session::getInstance()->get('user');

        $addressQuery = new UserAddressQuery();
        $adresses = $addressQuery->findByUserId($user->getId());

        $args['adresses'] = $adresses;

        $this->logger->info('User "'.$user->getId(). " - " . $user->getFirstname() . " " . $user->getLastname() .'" logged !');
        return $this->view->render($response, 'user/address.html', $args);
    })->setName('userAddress');

    $this->post('/address', function ($request, $response, $args) {
        $this->logger->info("POST '/user/address' route");
        $args['context'] = 'account';

        $user = Session::getInstance()->get('user');
        $now = date("Y-m-d H:i:s");

        $queryId = new UserAddressQuery();
        $lastAddress = $queryId->orderById('desc')->findOne();
        if ($lastAddress) {
            $addressId = $lastAddress->getId() + 1;
        } else {
            $addressId = 0;
        }

        $address = new UserAddress();
        $address->setId($addressId);
        $address->setCreationDate($now);
        $address->setModificationDate($now);
        $address->setFirstname($request->getParam('firstname'));
        $address->setLastname($request->getParam('lastname'));
        $address->setEmail($user->getEmail());
        $address->setAddressline1($request->getParam('address1'));
        $address->setAddressline2($request->getParam('address2'));
        $address->setAddressline3($request->getParam('address3'));
        $address->setCity($request->getParam('city'));
        $address->setZipcode($request->getParam('zipcode'));
        $address->setCompany($request->getParam('company'));
        $address->setCountry($request->getParam('country'));
        $address->setPhone($request->getParam('phone'));
        $address->setUserId($user->getId());

        $address->save();

        $message = Session::getInstance()->get('message');
        if (!$message)
        {
            $message = array();
        }
        $message[] = "Adresse créée avec succès !";

        $this->logger->info($message);

        Session::getInstance()->set('message', $message);

        return $response->withRedirect($this->router->pathFor('userAddress'));

    })->setName('userAddress');

    $this->get('/orders', function ($request, $response, $args) {
        $this->logger->info("GET '/user/orders' route");
        $args['context'] = 'account';

        $user = Session::getInstance()->get('user');

        $orderQuery = new OrderQuery();
        $orders = $orderQuery->findByUserId($user->getId());

        $args['orders'] = $orders;

        $this->logger->info('User "'.$user->getId(). " - " . $user->getFirstname() . " " . $user->getLastname() .'" logged !');
        return $this->view->render($response, 'user/orders.html', $args);
    })->setName('userOrder');

    $this->post('/orders', function ($request, $response, $args) {
        $this->logger->info("POST '/user/orders' route");
        $args['context'] = 'account';

        $user = Session::getInstance()->get('user');

        $this->logger->info('User "'.$user->getId(). " - " . $user->getFirstname() . " " . $user->getLastname() .'" logged !');
        return $this->view->render($response, 'user/index.html', $args);
    })->setName('userOrder');
});

//$app->group('/user', function () use ($app) {
//
//    $this->get('/{id}', function ($request, $response, $args) {
//        $this->logger->info("GET '/user/". $args['id'] . "' route");
//        $id = $args['id'];
//        $user = Session::getInstance()->get('user');
//
//        if ($user->getId() == $id){
//            $this->logger->info('User "'.$user->getId(). " - " . $user->getFirstname() . " " . $user->getLastname() .'" logged !');
//            return $this->view->render($response, 'user/index.html', $args);
//        } else {
//            return $response->withRedirect($this->router->pathFor('forbidden'), 403);
//        }
//
//    })->setName('userIndex');
//});


$app->get('/forbidden', function($request, $response, $args) use ($app){
    $this->logger->info("GET '/forbidden' route");
    return $this->view->render($response, '403.html', $args);
})->setName('forbidden');

$app->get('/404', function($request, $response, $args) use ($app){
    $this->logger->info("GET '/404' route");
    return $this->view->render($response, '404.html', $args);
})->setName('404');

$app->get('/aaa', function($request, $response, $args) use ($app) {
    /** @var Cart $cart */
    /** @var User $user */
    $this->logger->info("GET '/aaa' route");
    $args['context'] = 'aaa';
    $user = Session::getInstance()->get('user');
    $cartLine = new CartLine();
    $cartLine->qty = 2;
    $cartLine->label = "Tomates cerises";
    $cartLine->unitPrice = 1.00;
    $cartLine->sku = 'TOMCER1';

    $query = new CurrencyQuery();
    $currency = $query->filterById(1)->findOne();

    $cart = $user->getCart();
    $cart->setCurrency($currency);
    $cart->addCartLine($cartLine);

    $cartLine = new CartLine();
    $cartLine->qty = 3;
    $cartLine->label = "Tomates Coeur de boeuf";
    $cartLine->unitPrice = 2.50;
    $cartLine->sku = 'TOMBOE1';
    $cart->addCartLine($cartLine);

    $user->setCart($cart);
    Session::getInstance()->set('user', $user);
});

$app->get('/cart', function($request, $response, $args) use ($app) {
    $this->logger->info("GET '/cart' route");
    $args['context'] = 'cart';
    $user = Session::getInstance()->get('user');
    $this->logger->info("GET '/cart' => " . print_r($user->getCart(),true));
    $args['cart'] = $user->getCart();
    return $this->view->render($response, 'shop/cart.html', $args);
})->setName('cart');

$app->get('/mentions-legales', function($request, $response, $args) use ($app) {
    $this->logger->info("GET '/mentions-legales' route");
    $args['context'] = 'mentions-legales';
    return $this->view->render($response, 'mentions.html', $args);
})->setName('mentions-legales');

$app->post('/cart', function($request, $response, $args) use ($app) {
    $this->logger->info("POST '/cart' route");
    $ret = array('code' => '500');
    $user = Session::getInstance()->get('user');
    $cart = $user->getCart();
    $action = $request->getParam('action');

    if ($action == 'remove')
    {
        $sku = $request->getParam('sku');
        $qty = $request->getParam('qty');
        if (!empty($sku))
        {
            $initCount = $cart->getItemCount();
            $finalCount = count($cart->removeSku($sku));
            $this->logger->info("POST '/cart' init: " . $initCount . "\t final: ".$finalCount);
            if ($initCount > $finalCount) {
                $ret['code'] = 200;
            }
        }
    } else if ($action == 'modify') {
        if ($request->getParam('cartLines')){
            $cartLines = $request->getParam('cartLines');
            $total = 0;
            foreach ($cartLines as $cartLine) {
                $this->logger->info("POST '/cart' cartLines : " . print_r($cartLine, true));
                $cline = $cart->modifyQty($cartLine['sku'], $cartLine['qty']);
            }
            $ret['code'] = 200;
//            $cartLines = json_decode($request->getParam('cartLines'));
            $this->logger->info("POST '/cart' cartLines : " . print_r($cartLines, true));
        }
    } else if ($action == 'add'){

    }

    $user->setCart($cart);
    Session::getInstance()->set('user', $user);

    return json_encode($ret);
})->setName('cart');





//use \Application\Controller\Index;

//$app->get('/', '\Application\Controller\Index:index');

//$app->group('/variete', function () {
//    $this->group('/tomates', function() {
//        $this->map(['GET','POST'], '/', 'Application\Controller\Tomates:index');
//        $this->map(['GET','POST'], '/[{id}]/', 'App\controllers\AuthController:logout');
//    });
//});
//$app->get('/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//    // Render index view
//    return $this->renderer->render('index.html', $args);
//});

//$app->get('/', '\Application\Controller\Index:index');