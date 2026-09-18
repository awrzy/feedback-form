<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Message
{
    public function getAll(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT id, full_name, email, message, created_at FROM messages ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function create(string $fullName, string $email, string $message): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO messages (full_name, email, message) VALUES (:full_name, :email, :message)');
        return $stmt->execute([
            ':full_name' => $fullName,
            ':email'     => $email,
            ':message'   => $message,
        ]);
    }
}