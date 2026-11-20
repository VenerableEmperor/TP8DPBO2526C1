<?php

class Lecturer
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM lecturers ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM lecturers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO lecturers (name, nidn, email, department, phone, join_date)
             VALUES (:name, :nidn, :email, :department, :phone, :join_date)"
        );
        return $stmt->execute([
            ':name' => trim($data['name']),
            ':nidn' => trim($data['nidn']),
            ':email' => trim($data['email']),
            ':department' => trim($data['department']),
            ':phone' => trim($data['phone']),
            ':join_date' => $data['join_date'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE lecturers
             SET name = :name, nidn = :nidn, email = :email,
                 department = :department, phone = :phone, join_date = :join_date
             WHERE id = :id"
        );
        return $stmt->execute([
            ':id' => $id,
            ':name' => trim($data['name']),
            ':nidn' => trim($data['nidn']),
            ':email' => trim($data['email']),
            ':department' => trim($data['department']),
            ':phone' => trim($data['phone']),
            ':join_date' => $data['join_date'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM lecturers WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}