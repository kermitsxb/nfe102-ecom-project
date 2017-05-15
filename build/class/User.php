<?php

use Base\User as BaseUser;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser
{
    /**
     * Init cart
     */
    public function initCart()
    {
        if ($this->getCartserialized() === null)
        {
            $this->setCart(new Cart);
        }
    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        return unserialize($this->getCartserialized());
    }

    /**
     * @param Cart $cart
     */
    public function setCart($cart)
    {
        $this->setCartserialized(serialize($cart));
    }

    /**
     * Destroy cart
     */
    public function destroyCart()
    {
        $this->setCartserialized(null);
    }
}
