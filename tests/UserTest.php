<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO("sqlite:forum.db");
    }

    public function testUsersExist(): void
    {
        $stmt = $this->pdo->query("SELECT * FROM users");

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertNotEmpty(
            $users,
            "Keine Benutzer vorhanden."
        );
    }
}