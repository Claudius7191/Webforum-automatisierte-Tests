<?php

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testPasswordVerification(): void
    {
        $password = "Test123";

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->assertTrue(
            password_verify($password, $hash)
        );
    }
}