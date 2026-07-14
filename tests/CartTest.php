<?php

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testTotalPrice()
    {
        $price = 59.99;
        $quantity = 2;

        $total = $price * $quantity;

        $this->assertEquals(119.98, $total);
    }
}