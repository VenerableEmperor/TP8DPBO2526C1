<?php

require_once __DIR__ . '/../models/Lecturer.php';

class LecturerController
{
    private Lecturer $model;

    public function __construct(PDO $db)
    {
        $this->model = new Lecturer($db);
    }

    public function index(): void
    {
        $lecturers = $this->model->getAll();
        $editLecturer = null;

        if (isset($_GET['edit_id'])) {
            $editLecturer = $this->model->findById((int) $_GET['edit_id']);
        }

        require __DIR__ . '/../views/lecturers/index.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
        }
        header('Location: index.php?page=lecturers');
        exit;
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->model->update((int) $_POST['id'], $_POST);
        }
        header('Location: index.php?page=lecturers');
        exit;
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $this->model->delete((int) $_GET['id']);
        }
        header('Location: index.php?page=lecturers');
        exit;
    }
}