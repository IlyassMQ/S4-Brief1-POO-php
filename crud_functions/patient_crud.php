<?php
require_once 'classes/Patient.php';

class PatientCRUD
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function ajouterPatient()
    {
        echo "=== Ajouter un Patient ===\n";

        $nom = readline("Nom : ");
        $prenom = readline("Prénom : ");
        $email = readline("Email : ");
        $phone = readline("Téléphone : ");
        $dateNaissance = readline("Date de naissance (YYYY-MM-DD) : ");

        $patient = new Patient($this->db, $nom, $prenom, $email, $phone, $dateNaissance);
        $id = $patient->insert();

        echo "Patient ajouté avec succès. ID = $id\n";
    }

    public function supprimerPatient()
    {
        $id = (int)readline("Entrez l'ID du patient à supprimer : ");
        $patient = new Patient($this->db, '', '', '', '', '');
        $patient->setId($id);
        $patient->delete();
        echo "Patient supprimé !\n";
    }

    public function modifierPatient()
    {
        echo "=== Modifier un Patient ===\n";

        $id = (int)readline("Entrez l'ID du patient à modifier : ");
        $nom = readline("Nouveau nom : ");
        $prenom = readline("Nouveau prénom : ");
        $email = readline("Nouvel email : ");
        $phone = readline("Nouveau téléphone : ");
        $dateNaissance = readline("Nouvelle date de naissance (YYYY-MM-DD) : ");

        $patient = new Patient($this->db, $nom, $prenom, $email, $phone, $dateNaissance);
        $patient->setId($id);

        if ($patient->update()) {
            echo "Patient avec ID $id mis à jour avec succès.\n";
        } else {
            echo "Erreur lors de la mise à jour du patient.\n";
        }
    }

    public function listerPatients()
    {
    echo "=== Liste des Patients ===\n";

    // get all patients from the database
    $patients = Patient::getAll($this->db);

    if (empty($patients)) {
        echo "Aucun patient trouvé.\n";
        return;
    }

    // Display  patient
    foreach ($patients as $patient) {
        echo "ID: " . $patient['patient_id'] .
             " | Nom: " . $patient['last_name'] .
             " | Prénom: " . $patient['first_name'] .
             " | Email: " . $patient['email'] .
             " | Téléphone: " . $patient['phone'] .
             " | Date de naissance: " . $patient['birth_date'] . "\n";
        }
    }

}
