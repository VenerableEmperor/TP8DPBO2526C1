<?php

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/LecturerController.php';
require_once __DIR__ . '/controllers/CourseController.php';
require_once __DIR__ . '/controllers/ResearchProjectController.php';

$db = (new Database())->getConnection();

$page = $_GET['page'] ?? 'lecturers';
$action = $_GET['action'] ?? 'index';

$controller = match ($page) {
    'courses' => new CourseController($db),
    'research' => new ResearchProjectController($db),
    default => new LecturerController($db),
};

if (!method_exists($controller, $action)) {
    $action = 'index';
}

$controller->$action();