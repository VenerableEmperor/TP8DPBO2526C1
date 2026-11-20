<?php

class Course
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllWithLecturer(): array
    {
        $sql = "SELECT c.*, l.name AS lecturer_name, l.nidn, l.department
                FROM courses c
                JOIN lecturers l ON c.lecturer_id = l.id
                ORDER BY c.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO courses (lecturer_id, course_code, course_name, credits, semester)
             VALUES (:lecturer_id, :course_code, :course_name, :credits, :semester)"
        );
        return $stmt->execute([
            ':lecturer_id' => (int) $data['lecturer_id'],
            ':course_code' => trim($data['course_code']),
            ':course_name' => trim($data['course_name']),
            ':credits' => (int) $data['credits'],
            ':semester' => trim($data['semester']),
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE courses
             SET lecturer_id = :lecturer_id, course_code = :course_code,
                 course_name = :course_name, credits = :credits, semester = :semester
             WHERE id = :id"
        );
        return $stmt->execute([
            ':id' => $id,
            ':lecturer_id' => (int) $data['lecturer_id'],
            ':course_code' => trim($data['course_code']),
            ':course_name' => trim($data['course_name']),
            ':credits' => (int) $data['credits'],
            ':semester' => trim($data['semester']),
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM courses WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}