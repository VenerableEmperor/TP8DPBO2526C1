<?php

require_once __DIR__ . '/../models/ResearchProject.php';
require_once __DIR__ . '/../models/Lecturer.php';

class ResearchProjectController
{
    private ResearchProject $researchModel;
    private Lecturer $lecturerModel;

    public function __construct(PDO $db)
    {
        $this->researchModel = new ResearchProject($db);
        $this->lecturerModel = new Lecturer($db);
    }

    public function index(): void
    {
        $projects = $this->researchModel->getAllWithLecturer();
        $lecturers = $this->lecturerModel->getAll();
        $editProject = null;

        if (isset($_GET['edit_id'])) {
            $editProject = $this->researchModel->findById((int) $_GET['edit_id']);
        }

        require __DIR__ . '/../views/research_projects/index.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->researchModel->create($_POST);
        }
        header('Location: index.php?page=research');
        exit;
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->researchModel->update((int) $_POST['id'], $_POST);
        }
        header('Location: index.php?page=research');
        exit;
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $this->researchModel->delete((int) $_GET['id']);
        }
        header('Location: index.php?page=research');
        exit;
    }
}