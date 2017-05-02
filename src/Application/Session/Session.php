<?php

/*
SSMC - Simple SessionManagement Class
Copyright (C) 2012  Karpouzas George

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see
<http://www.gnu.org/licenses/>.
*/

namespace Application\Session;

class Session
{
    private static $_instance;

    private function __construct()
    {
        if (!isset($_SESSION) && (session_id() == '')) {
            session_start();
            session_regenerate_id(true);
            session_name(md5(uniqid(rand(), true)));
        }
    }

    /**
     *
     * get input class instance (only one is created)
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new session();
        }

        return self::$_instance;
    }

    /**
     *
     * Get Session param value
     * @param string $index
     */
    public function get($index)
    {
        if (!isset($_SESSION)) return false;
        if (!empty($index) && !empty ($_SESSION)) {
            if (isset($_SESSION[$index])) {
//                return filter_var($_SESSION[$index], FILTER_SANITIZE_STRING);
                return unserialize($_SESSION[$index]);
            }
        }
        return false;
    }

    /**
     *
     * set session param
     * @param string $index
     * @param mixed $value
     */
    public function set($index, $value)
    {
        if (!isset($_SESSION)) return false;
        if (!empty($index)) {
            $_SESSION[$index] = serialize($value);
            return true;
        }
        return false;
    }

    /**
     *
     * remove a session param and return its value
     * @param string $index
     */
    public function remove($index)
    {
        if (!isset($_SESSION)) return false;
        if (!empty($index) && !empty ($_SESSION)) {
            if (isset($_SESSION[$index]))
                $value = filter_var($_SESSION[$index], FILTER_SANITIZE_STRING);
            unset($_SESSION[$index]);
            unset($index);
            return $value;
        }
        return false;
    }

    /**
     *
     * delete a session param
     * @param string $index
     */
    public function delete($index)
    {
        if (!isset($_SESSION)) return false;
        if (!empty($index) && !empty ($_SESSION)) {
            if (isset($_SESSION[$index]))
                unset($_SESSION[$index]);
            unset($index);
            return true;
        }
        return false;
    }

    /**
     *
     * destroy everything
     */
    public function destroy()
    {
        session_unset();
        session_destroy();
    }
}