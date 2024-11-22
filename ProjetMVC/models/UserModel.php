<?php
require_once __DIR__ . '/../config.php';

// UserModel.php

class UserModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer tous les utilisateurs
    public function getAllUsers() {
        $query = "SELECT * FROM clients";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Ajouter un utilisateur avec mot de passe haché
    public function addUser($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT); // Hachage du mot de passe
        $query = "INSERT INTO clients (nom, prenom, email, username, password, number, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "sssssss", // Le dernier `s` est pour `number`
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['username'],
            $data['password'], // Utilisation du mot de passe haché
            $data['number'],
            $data['role']
        );
        return $stmt->execute();
    }
    
    // Supprimer un utilisateur
    public function deleteUser($id) {
        $query = "DELETE FROM clients WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $query = "SELECT * FROM clients WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $data) {
        $query = "UPDATE clients SET nom = ?, prenom = ?, email = ?, password = ?, username = ?, number = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(
            "ssssssi",
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['password'],
            $data['username'],
            $data['number'],
            $id
        );
        return $stmt->execute();
    }

    // Récupérer un utilisateur par son username pour la connexion
    public function getUserByUsername($username) {
        $query = "SELECT * FROM clients WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Retourne l'utilisateur trouvé
    }
    
}
?>
