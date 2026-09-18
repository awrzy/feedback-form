<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Message;

class FeedbackController
{
    public function index(): void
    {
        $messages = (new Message())->getAll();
        require __DIR__ . '/../Views/feedback.php';
    }

    public function store(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $fullName = trim($_POST['full_name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $message  = trim($_POST['message'] ?? '');

        $errors = [];

        if ($fullName === '') {
            $errors[] = 'ФИО обязательно';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Некорректный email';
        }

        if ($message === '') {
            $errors[] = 'Сообщение обязательно';
        } elseif (mb_strlen($message) > 500) {
            $errors[] = 'Сообщение не должно превышать 500 символов';
        }

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors], JSON_UNESCAPED_UNICODE);
            return;
        }

        $safeName    = htmlspecialchars($fullName, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeEmail   = htmlspecialchars($email, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $safeMessage = htmlspecialchars($message, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $created = (new Message())->create($safeName, $safeEmail, $safeMessage);

        echo json_encode(['success' => $created], JSON_UNESCAPED_UNICODE);
    }

    public function list(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $messages = (new Message())->getAll();
        echo json_encode($messages, JSON_UNESCAPED_UNICODE);
    }
}