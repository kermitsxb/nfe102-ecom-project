<?php

class Cart
{
    /** @var CartLine[] */
    private $cartLines;

    /** @var float */
    private $totalAmount;

    /** @var Currency  */
    private $currency;

    public function __construct()
    {
        $this->cartLines = array();
        $this->totalAmount = 0;
        $this->currency = null;
    }

    /**
     * @param $currency Currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currency->getCode();
    }

    /**
     * @return CartLine[]
     */
    public function getCartLines()
    {
        return $this->cartLines;
    }

    /**
     * @param $cartLine CartLine
     */
    public function addCartLine($cartLine)
    {
        $this->cartLines[] = $cartLine;
        $this->totalAmount += $cartLine->unitPrice * $cartLine->qty;
    }

    /**
     * @param $cartLine CartLine
     */
    public function removeCartLine($cartLine)
    {
        if(($key = array_search($cartLine, $this->cartLines, true)) !== FALSE) {
            $this->totalAmount -= $cartLine->unitPrice * $cartLine->qty;
            unset($this->cartLines[$key]);
        }
        if ($this->getItemCount() == 0)
        {
            $this->totalAmount = 0;
        }
        return $this->cartLines;
    }

    /**
     * @param $sku string
     */
    public function removeSku($sku)
    {
        foreach ($this->cartLines as $cartLine)
        {
            if ($cartLine->sku == $sku)
            {
                return $this->removeCartLine($cartLine);
            }
        }
    }

    /**
     * @param $sku string
     */
    public function modifyQty($sku, $qty)
    {
        $cartLine = $this->findSku($sku);
        $cartLine->qty = $qty;
        $this->refreshTotalAmount();
    }

    private function refreshTotalAmount()
    {
        $total = 0;
        foreach($this->cartLines as $cartLine)
        {
            $total += $cartLine->unitPrice * $cartLine->qty;
        }
        $this->totalAmount = $total;
    }

    /**
     * @param $sku string
     */
    public function &findSku($sku)
    {
        foreach ($this->cartLines as $cartLine)
        {
            if ($cartLine->sku == $sku)
            {
                return $cartLine;
            }
        }
        return null;
    }

    /**
     * @return float|int
     */
    public function getTotalAmount()
    {
        return (float)$this->totalAmount;
    }

    /**
     * @return int
     */
    public function getItemCount()
    {
        return count($this->cartLines);
    }
}