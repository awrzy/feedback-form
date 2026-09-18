<?php

declare(strict_types=1);

require __DIR__ . '/../app/Core/Database.php';
require __DIR__ . '/../app/Models/Message.php';
require __DIR__ . '/../app/Controllers/FeedbackController.php';

use App\Controllers\FeedbackController;

$action = $_GET['action'] ?? 'index';
$controller = new FeedbackController();

match ($action) {
    'store' => $controller->store(),
    'list'  => $controller->list(),
    default => $controller->index(),
};