<?php
require_once 'personne.php';

class Patient extends Personne
{
    private int $id;
    private string $dateNaissance;
    private int $departmentId;
    private PDO $db;

    public function __construct(PDO $db, string $nom, string $prenom, string $email, string $phone, string $dateNaissance)
    {
        parent::__construct($nom, $prenom, $email, $phone);
        $this->db = $db;
        $this->dateNaissance = $dateNaissance;
    }

      public function setId(int $id): void
    {
        $this->id = $id;
    }
//=============INSERT================

    public function insert(): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO patients (last_name, first_name, email, phone, birth_date)
            VALUES (:nom, :prenom, :email, :phone, :date_naissance)
        ");
        $stmt->execute([
            ':nom' => $this->getNom(),
            ':prenom' => $this->getPrenom(),
            ':email' => $this->getEmail(),
            ':phone' => $this->getPhone(),
            ':date_naissance' => $this->dateNaissance
        ]);

        return (int)$this->db->lastInsertId();
    }
//=============DELETE================
    public function delete(): bool
    {
        $stmt = $this->db->prepare("DELETE FROM patients WHERE patient_id = :id");
        $stmt->execute([':id' => $this->id]);
        return true;
    }
        //=============UPDATE================
    public function update(): bool
    {

        $stmt = $this->db->prepare("
            UPDATE patients
            SET last_name = :nom,
                first_name = :prenom,
                email = :email,
                phone = :phone,
                birth_date = :date_naissance
            WHERE patient_id = :id
        ");

        return $stmt->execute([
            ':nom' => $this->getNom(),
            ':prenom' => $this->getPrenom(),
            ':email' => $this->getEmail(),
            ':phone' => $this->getPhone(),
            ':date_naissance' => $this->dateNaissance,
            ':id' => $this->id
        ]);
    }

    //==================GET ALL===============
    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM patients");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
