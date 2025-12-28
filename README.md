# S4-Brief1-POO-php

# 🏥 Unity Care Clinic – Version CLI (PHP OOP)

## 📌 Description du projet

Suite au développement de la version web procédurale de **Unity Care Clinic**, l’équipe technique a décidé de créer une **version console (CLI)** du système en adoptant une **architecture orientée objet en PHP 8**.

Cette application CLI sert d’outil interne permettant la **gestion rapide des données** (patients, médecins, départements) sans passer par une interface web.  
Elle est conçue pour être **maintenable, extensible et structurée**, en respectant les principes de la programmation orientée objet.

---

## 🎯 Objectifs du projet

- Refactoriser la logique métier en **architecture orientée objet PHP 8**
- Structurer le projet en **classes métiers cohérentes**
- Appliquer les concepts d’**encapsulation, héritage et séparation des responsabilités**
- Implémenter une **couche d’accès aux données via PDO**
- Créer une **interface console interactive** pour les opérations CRUD

---


---

## 🧑‍💼 Classes principales

### 🔹 Personne (classe mère)
- Propriétés communes : nom, prénom, email, téléphone
- Getters et setters
- Méthode utilitaire `getFullName()`

### 🔹 Patient (hérite de Personne)
- Gestion des informations patient
- Méthodes CRUD via PDO
- Interaction directe avec la base de données

### 🔹 Doctor (hérite de Personne)
- Association à un département existant
- CRUD complet
- Validation du département via la base de données

### 🔹 Department
- Gestion des départements médicaux
- CRUD complet
- Référencé par les médecins

---

## 💾 Accès aux données

- Utilisation de **PDO** pour la connexion à la base de données
- Requêtes préparées pour sécuriser les opérations CRUD
- Connexion centralisée via la classe `Database`

---

## 🖥️ Interface Console (CLI)

### Menu principal

=== Unity Care CLI ===

1 - Gérer les patients

2 -Gérer les médecins

3 -Gérer les départements

4 -Quitter


### Exemple – Gestion des patients

=== Gestion des Patients ===

1 -Lister les patients

2 -Ajouter un patient

3 -Modifier un patient

4 -Supprimer un patient

5 -Retour

---
## 🧩 Fonctionnalités implémentées

- CRUD Patients
- CRUD Médecins
- CRUD Départements
- Menu interactif en ligne de commande
- Architecture orientée objet
- Héritage (`Personne → Patient / Doctor`)
- Séparation claire des responsabilités
- PDO avec requêtes préparées