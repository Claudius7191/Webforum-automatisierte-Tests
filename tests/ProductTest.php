<?php

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO("sqlite:forum.db");
    }

    public function testProductsExist(): void
    {
        $stmt = $this->pdo->query("SELECT * FROM product");

            $product = $stmt->fetch(PDO::FETCH_ASSOC);

$this->assertArrayHasKey('name', $product);
$this->assertArrayHasKey('price', $product);
$this->assertGreaterThan(0, $product['price']);
        
    }
}