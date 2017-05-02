<?php
namespace Application\Controller;

use Application\View\View;

class Index extends BaseController
{
    public function indexAction(array $args)
    {
//        return new View('index.html');
        return new View('index.html', [
            'name' => $args['name']
        ]);
    }
}