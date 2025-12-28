<?php
require_once 'personne.php';

class Doctor extends Personne
{
    private int $id;
    private int $departementId;
    private PDO $db;

    public function __construct(
        PDO $db,
        string $nom,
        string $prenom,
        string $email,
        string $phone,
        int $departementId
    ) {
        parent::__construct($nom, $prenom, $email, $phone);
        $this->db = $db;
        $this->departementId = $departementId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // ============= INSERT =================
    public function insert(): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO doctors (last_name, first_name, email, phone, department_id)
            VALUES (:nom, :prenom, :email, :phone, :department_id)
        ");

        $stmt->execute([
            ':nom' => $this->getNom(),
            ':prenom' => $this->getPrenom(),
            ':email' => $this->getEmail(),
            ':phone' => $this->getPhone(),
            ':department_id' => $this->departementId
        ]);

        return (int)$this->db->lastInsertId();
    }

    // ============= DELETE =================
    public function delete(): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM doctors WHERE doctor_id = :id"
        );

        return $stmt->execute([
            ':id' => $this->id
        ]);
    }

    // ============= UPDATE =================
    public function update(): bool
    {
        $stmt = $this->db->prepare("
            UPDATE doctors
            SET last_name = :nom,
                first_name = :prenom,
                email = :email,
                phone = :phone,
                department_id = :department_id
            WHERE doctor_id = :id
        ");

        return $stmt->execute([
            ':nom' => $this->getNom(),
            ':prenom' => $this->getPrenom(),
            ':email' => $this->getEmail(),
            ':phone' => $this->getPhone(),
            ':department_id' => $this->departementId,
            ':id' => $this->id
        ]);
    }

    // ============= GET ALL =================
    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("
            SELECT d.*, dep.name AS departement_name
            FROM doctors d
            JOIN departments dep ON d.department_id = dep.department_id
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
