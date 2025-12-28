<?php
require_once 'classes\Departement.php';

class DepartmentCRUD
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // ++++++++++++++ ADD DEPARTMENT ++++++++++++++
    public function ajouterDepartement()
    {
        echo "=== Ajouter un Département ===\n";

        $name = readline("Nom du département : ");
        $description = readline("Description : ");

        $department = new Department($this->db, $name, $description);
        $id = $department->insert();

        echo "Département ajouté avec succès. ID = $id\n";
    }

    // ++++++++++++++ DELETE DEPARTMENT ++++++++++++++
    public function supprimerDepartement()
    {
        $id = (int)readline("Entrez l'ID du département à supprimer : ");
        $department = new Department($this->db, '', '');
        $department->setId($id);
        $department->delete();
        echo "Département supprimé !\n";
    }

    // ++++++++++++++ UPDATE DEPARTMENT ++++++++++++++
    public function modifierDepartement()
    {
        echo "=== Modifier un Département ===\n";

        $id = (int)readline("Entrez l'ID du département à modifier : ");
        $name = readline("Nouveau nom : ");
        $description = readline("Nouvelle description : ");

        $department = new Department($this->db, $name, $description);
        $department->setId($id);

        if ($department->update()) {
            echo "Département avec ID $id mis à jour avec succès.\n";
        } else {
            echo "Erreur lors de la mise à jour du département.\n";
        }
    }

    // ++++++++++++++ LIST DEPARTMENTS ++++++++++++++
    public function listerDepartements()
    {
        echo "=== Liste des Départements ===\n";

        $departments = Department::getAll($this->db);

        if (empty($departments)) {
            echo "Aucun département trouvé.\n";
            return;
        }

        foreach ($departments as $department) {
            echo "ID: " . $department['department_id'] .
                 " | Nom: " . $department['name'] .
                 " | Description: " . $department['description'] . "\n";
        }
    }
}
