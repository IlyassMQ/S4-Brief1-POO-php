<?php
class Personne
{
    private string $nom;
    private string $prenom;
    private string $email;
    private string $phone;

    public function __construct(
        string $nom,
        string $prenom,
        string $email,
        string $phone
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->phone = $phone;
    }


    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }


    public function setNom(string $nom): void
    {
        if (empty($nom)) {
            throw new InvalidArgumentException("Le nom ne peut pas être vide.");
        }
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        if (empty($prenom)) {
            throw new InvalidArgumentException("Le prénom ne peut pas être vide.");
        }
        $this->prenom = $prenom;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide.");
        }
        $this->email = $email;
    }

    public function setPhone(string $phone): void
    {
        if (!preg_match('/^[0-9+\-\s]+$/', $phone)) {
            throw new InvalidArgumentException("Numéro de téléphone invalide.");
        }
        $this->phone = $phone;
    }
    
}




