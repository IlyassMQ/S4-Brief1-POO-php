<?php
require  'config/cnx_db.php';
require_once 'classes/Patient.php';
require_once 'classes/Personne.php';
require_once 'crud_functions/patient_crud.php';
class Menu
{

    private PDO $db;
    private PatientCRUD $patientCRUD;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->patientCRUD = new PatientCRUD($db);
    }

    public function afficherMenuPrincipal()
    {
        
        echo "=== Unity Care CLI ===\n";
        echo "1. Gérer les patients\n";
        echo "2. Gérer les médecins\n";
        echo "3. Gérer les départements\n";
        echo "4. Statistiques\n";
        echo "5. Quitter\n";
    }

    public function afficherMenuPatients()
    {
        echo "=== Gestion des Patients ===\n";
        echo "1. Lister les patients\n";
        echo "2. Ajouter un patient\n";
        echo "3. Modifier un patient\n";
        echo "4. Supprimer un patient\n";
        echo "5. Retour\n";
    }

    public function gererPatients()
{
    while (true) {
        $this->afficherMenuPatients();
        $choix = readline("Votre choix : ");

        if ($choix == "1") {
            $this->patientCRUD->listerPatients();

        }
        
        elseif ($choix == "2") {
             $this->patientCRUD->ajouterPatient();
        }
        elseif ($choix == "3") {
            $this->patientCRUD->modifierPatient();
        }
        elseif ($choix == "4") {
            $this->patientCRUD->supprimerPatient();

        }
        elseif ($choix == "5") {
            break; 
        }
    }
}

    public function afficherMenuDoctors()
    {
       
        echo "=== Gestion des Dotore ===\n";
        echo "1. Lister les Dotore\n";
        echo "2. Rechercher un Dotore\n";
        echo "3. Ajouter un Dotore\n";
        echo "4. Modifier un Dotore\n";
        echo "5. Supprimer un Dotore\n";
        echo "6. Retour\n";
    }

    public function afficherMenuDepartement()
    {
        
        echo "=== Gestion des Departement ===\n";
        echo "1. Lister les Departement\n";
        echo "2. Rechercher un Departement\n";
        echo "3. Ajouter un Departement\n";
        echo "4. Modifier un Departement\n";
        echo "5. Supprimer un Departement\n";
        echo "6. Retour\n";
    }

    public function afficher()
    {
        while (true) {
            $this->afficherMenuPrincipal();
            $choix = readline("Votre choix : ");

            if ($choix == "1") {
                $this->gererPatients();
            }
            elseif ($choix == "2") {
                $this->afficherMenuDoctors();
                
            }
            elseif ($choix == "3") {
                $this->afficherMenuDepartement();
                
            }
            elseif ($choix == "5") {
                echo "Au revoir\n";
                break;
            }
           
        }
    }

}
// Create database connection
$db = (new Database())->connect();
$menu = new Menu($db);
$menu->afficher();
