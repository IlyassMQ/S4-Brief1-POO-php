<?php
require_once 'classes/Doctor.php';

class DoctorCRUD
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // ============= ADD =================
    public function ajouterDoctor()
{
    echo "=== Ajouter un Médecin ===\n";

    $nom = readline("Nom : ");
    $prenom = readline("Prénom : ");
    $email = readline("Email : ");
    $phone = readline("Téléphone : ");

    $departementId = $this->choisirDepartement();

    if ($departementId === 0) {
        return;
    }

    $doctor = new Doctor(
        $this->db,
        $nom,
        $prenom,
        $email,
        $phone,
        $departementId
    );

    $id = $doctor->insert();
    echo "Médecin ajouté avec succès. ID = $id\n";
}


    // ============= DELETE =================
    public function supprimerDoctor()
    {
        $id = (int) readline("Entrez l'ID du médecin à supprimer : ");

        // valeurs vides juste pour créer l'objet
        $doctor = new Doctor($this->db, '', '', '', '', 0);
        $doctor->setId($id);
        $doctor->delete();

        echo "Médecin supprimé !\n";
    }

    // ============= UPDATE =================
    public function modifierDoctor()
    {
        echo "=== Modifier un Médecin ===\n";

        $id = (int) readline("Entrez l'ID du médecin à modifier : ");
        $nom = readline("Nouveau nom : ");
        $prenom = readline("Nouveau prénom : ");
        $email = readline("Nouvel email : ");
        $phone = readline("Nouveau téléphone : ");
        $departementId = (int) readline("Nouvel ID du département : ");

        $doctor = new Doctor(
            $this->db,
            $nom,
            $prenom,
            $email,
            $phone,
            $departementId
        );

        $doctor->setId($id);

        if ($doctor->update()) {
            echo "Médecin avec ID $id mis à jour avec succès.\n";
        } else {
            echo "Erreur lors de la mise à jour du médecin.\n";
        }
    }

    // ============= LIST =================
    public function listerDoctors()
    {
        echo "=== Liste des Médecins ===\n";

        $doctors = Doctor::getAll($this->db);

        if (empty($doctors)) {
            echo "Aucun médecin trouvé.\n";
            return;
        }

        foreach ($doctors as $doctor) {
            echo "ID: " . $doctor['doctor_id'] .
                 " | Nom: " . $doctor['last_name'] .
                 " | Prénom: " . $doctor['first_name'] .
                 " | Email: " . $doctor['email'] .
                 " | Téléphone: " . $doctor['phone'] .
                 " | Département: " . $doctor['departement_name'] . "\n";
        }
    }

    private function choisirDepartement(): int
{
    $departements = Department::getAll($this->db);

    echo "=== Départements disponibles ===\n";
    foreach ($departements as $dep) {
        echo $dep['department_id'] . " - " . $dep['name'] . "\n";
    }

    while (true) {
        $choix = (int) readline("Choisissez l'ID du département : ");

        foreach ($departements as $dep) {
            if ($dep['department_id'] === $choix) {
                return $choix; 
            }
        }

        echo "ID invalide. Réessayez.\n";
    }
}

}
