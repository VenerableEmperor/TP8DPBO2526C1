<?php

require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Lecturer.php';

class CourseController
{
    private Course $courseModel;
    private Lecturer $lecturerModel;

    public function __construct(PDO $db)
    {
        $this->courseModel = new Course($db);
        $this->lecturerModel = new Lecturer($db);
    }

    public function index(): void
    {
        $courses = $this->courseModel->getAllWithLecturer();
        $lecturers = $this->lecturerModel->getAll();
        $editCourse = null;

        if (isset($_GET['edit_id'])) {
            $editCourse = $this->courseModel->findById((int) $_GET['edit_id']);
        }

        require __DIR__ . '/../views/courses/index.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->courseModel->create($_POST);
        }
        header('Location: index.php?page=courses');
        exit;
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->courseModel->update((int) $_POST['id'], $_POST);
        }
        header('Location: index.php?page=courses');
        exit;
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $this->courseModel->delete((int) $_GET['id']);
        }
        header('Location: index.php?page=courses');
        exit;
    }
}