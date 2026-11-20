<?php

class ResearchProject
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllWithLecturer(): array
    {
        $sql = "SELECT r.*, l.name AS lecturer_name, l.nidn, l.department
                FROM research_projects r
                JOIN lecturers l ON r.lecturer_id = l.id
                ORDER BY r.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM research_projects WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO research_projects (lecturer_id, title, year, funding_source, status)
             VALUES (:lecturer_id, :title, :year, :funding_source, :status)"
        );
        return $stmt->execute([
            ':lecturer_id' => (int) $data['lecturer_id'],
            ':title' => trim($data['title']),
            ':year' => (int) $data['year'],
            ':funding_source' => trim($data['funding_source']),
            ':status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE research_projects
             SET lecturer_id = :lecturer_id, title = :title, year = :year,
                 funding_source = :funding_source, status = :status
             WHERE id = :id"
        );
        return $stmt->execute([
            ':id' => $id,
            ':lecturer_id' => (int) $data['lecturer_id'],
            ':title' => trim($data['title']),
            ':year' => (int) $data['year'],
            ':funding_source' => trim($data['funding_source']),
            ':status' => $data['status'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM research_projects WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}