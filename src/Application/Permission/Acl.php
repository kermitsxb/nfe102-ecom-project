<?php

namespace Application\Permission;

use Zend\Permissions\Acl\Acl as ZendAcl;

class Acl extends ZendAcl
{
    public function __construct()
    {
        // APPLICATION ROLES
        $this->addRole('guest');
        // member role "extends" guest, meaning the member role will get all of
        // the guest role permissions by default
        $this->addRole('member', 'guest');
        $this->addRole('admin');

        // APPLICATION RESOURCES
        // Application resources == Slim route patterns
        $this->addResource('/');
        $this->addResource('/[{name}]');
//        $this->addResource('/user/{id}');
        $this->addResource('/user/');
        $this->addResource('/user/address');
        $this->addResource('/user/orders');
        $this->addResource('/register');
        $this->addResource('/forbidden');
        $this->addResource('/404');
        $this->addResource('/login');
        $this->addResource('/logout');
        $this->addResource('/variete/tomates');
        $this->addResource('/variete/aromatiques');
        $this->addResource('/member');
        $this->addResource('/admin');
        $this->addResource('/cart');
        $this->addResource('/mentions-legales');
        $this->addResource('/aaa');
        $this->addResource('/search');

        // APPLICATION PERMISSIONS
        // Now we allow or deny a role's access to resources. The third argument
        // is 'privilege'. We're using HTTP method as 'privilege'.
        $this->allow('guest', '/', 'GET');
        $this->allow('guest', '/forbidden', 'GET');
        $this->allow('guest', '/404', 'GET');
        $this->allow('guest', '/mentions-legales', 'GET');
        $this->allow('guest', '/variete/tomates', 'GET');
        $this->allow('guest', '/variete/aromatiques', 'GET');
//        $this->allow('guest', '/[{name}]', 'GET');
        $this->allow('guest', '/register', ['POST']);
        $this->allow('guest', '/search', ['POST']);
        $this->allow('guest', '/login', ['GET', 'POST']);
        $this->allow('guest', '/logout', 'GET');
        $this->allow('guest', '/cart', ['GET','POST']);

        $this->allow('member', '/member', 'GET');
        $this->allow('member', '/aaa', 'GET');
//        $this->allow('member', '/user/{id}', 'GET');
        $this->allow('member', '/user/', ['GET', 'POST']);
        $this->allow('member', '/user/address', ['GET', 'POST']);
        $this->allow('member', '/user/orders', ['GET', 'POST']);

        // This allows admin access to everything
        $this->allow('admin');
    }
}