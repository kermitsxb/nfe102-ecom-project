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
        $this->addResource('/login');
        $this->addResource('/logout');
        $this->addResource('/member');
        $this->addResource('/admin');

        // APPLICATION PERMISSIONS
        // Now we allow or deny a role's access to resources. The third argument
        // is 'privilege'. We're using HTTP method as 'privilege'.
        $this->allow('guest', '/', 'GET');
        $this->allow('guest', '/[{name}]', 'GET');
        $this->allow('guest', '/login', ['GET', 'POST']);
        $this->allow('guest', '/logout', 'GET');

        $this->allow('member', '/member', 'GET');

        // This allows admin access to everything
        $this->allow('admin');
    }
}