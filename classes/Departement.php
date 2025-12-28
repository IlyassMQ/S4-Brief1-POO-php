<?php
class Department
{
    private int $id;
    private string $name;
    private string $description;
    private PDO $db;

    public function __construct(PDO $db, string $name, string $description)
    {
        $this->db = $db;
        $this->name = $name;
        $this->description = $description;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    //=============INSERT================
    public function insert(): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO departments (name, description)
            VALUES (:name, :description)
        ");
        $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description
        ]);

        return (int)$this->db->lastInsertId();
    }

    //=============DELETE================
    public function delete(): bool
    {
        $stmt = $this->db->prepare("DELETE FROM departments WHERE department_id = :id");
        $stmt->execute([':id' => $this->id]);
        return true;
    }

    //=============UPDATE================
    public function update(): bool
    {
        $stmt = $this->db->prepare("
            UPDATE departments
            SET name = :name,
                description = :description
            WHERE department_id = :id
        ");

        return $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':id' => $this->id
        ]);
    }

    //==================GET ALL=============== 
    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM departments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
