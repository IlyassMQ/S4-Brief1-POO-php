<?php
require  'config/cnx_db.php';
require_once 'classes/Patient.php';
require_once 'classes/Personne.php';
require_once 'crud_functions/patient_crud.php';
require_once 'crud_functions/department_crud.php';
require_once 'crud_functions/doctor_crud.php';
class Menu
{

    private PDO $db;
    private PatientCRUD $patientCRUD;
    private DepartmentCRUD $departementCRUD;
    private DoctorCRUD $doctorCRUD;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->patientCRUD = new PatientCRUD($db);
        $this->departementCRUD = new DepartmentCRUD($db);
        $this->doctorCRUD = new DoctorCRUD($db);
    }

    public function afficherMenuPrincipal()
    {
        
        echo "=== Unity Care CLI ===\n";
        echo "1. Gérer les patients\n";
        echo "2. Gérer les médecins\n";
        echo "3. Gérer les départements\n";
        echo "4. Quitter\n";
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
       
        echo "=== Gestion des Doctore ===\n";
        echo "1. Lister les Doctore\n";
        echo "2. Ajouter un Doctore\n";
        echo "3. Modifier un Doctore\n";
        echo "4. Supprimer un Doctore\n";
        echo "5. Retour\n";
    }

    public function gererDoctors()
    {
        while (true) {
            $this->afficherMenuDoctors();
            $choix = readline("Votre choix : ");

            if ($choix == "1") {
                $this->doctorCRUD->listerDoctors();
            }
            elseif ($choix == "2") {
                $this->doctorCRUD->ajouterDoctor();
            }
            elseif ($choix == "3") {
                $this->doctorCRUD->modifierDoctor();
            }
            elseif ($choix == "4") {
                $this->doctorCRUD->supprimerDoctor();
            }
            elseif ($choix == "5") {
                break; // retour menu principal
            }
        }
    }

    public function afficherMenuDepartement()
    {
        
        echo "=== Gestion des Departement ===\n";
        echo "1. Lister les Departement\n";
        echo "2. Ajouter un Departement\n";
        echo "3. Modifier un Departement\n";
        echo "4. Supprimer un Departement\n";
        echo "5. Retour\n";
    }

        public function gererDepartements()
    {
        while (true) {
            $this->afficherMenuDepartement();
            $choix = readline("Votre choix : ");

            if ($choix == "1") {
                $this->departementCRUD->listerDepartements();
            }
            elseif ($choix == "2") {
                $this->departementCRUD->ajouterDepartement();
            }
            elseif ($choix == "3") {
                $this->departementCRUD->modifierDepartement();
            }
            elseif ($choix == "4") {
                $this->departementCRUD->supprimerDepartement();
            }
            elseif ($choix == "5") {
                break; // retourne au menu principal
            }
        }
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
                $this->gererDoctors();
                
            }
            elseif ($choix == "3") {
                $this->gererDepartements();
                
            }
            elseif ($choix == "4") {
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
