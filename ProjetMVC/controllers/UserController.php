<?php 
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Afficher tous les utilisateurs
    public function displayUsers() {
        return $this->userModel->getAllUsers();
    }

    // Ajouter un utilisateur
    public function addUser($data) {
        return $this->userModel->addUser($data);
    }

    // Supprimer un utilisateur
    public function deleteUser($id) {
        return $this->userModel->deleteUser($id);
    }

    // Récupérer un utilisateur par son ID
    public function getUser($id) {
        return $this->userModel->getUserById($id);
    }

    // Mettre à jour un utilisateur
    public function updateUser($id, $data) {
        return $this->userModel->updateUser($id, $data);
    }

    // Connexion de l'utilisateur
    public function signin($username, $password) {
        // Récupérer l'utilisateur par son username
        $user = $this->userModel->getUserByUsername($username); // Assure-toi que cette méthode existe dans ton modèle
    
        if ($user && password_verify($password, $user['password'])) {
            // Si le mot de passe est correct
            if ($user['role'] === 'client') {
                // HTML contenu pour le client directement dans la fonction
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Hello Page</title>
                </head>
                <body>
                    <h1>Hello, ' . htmlspecialchars($username) . '!</h1>
                </body>
                </html>
                ';
                exit();
            } else {
                // Page pour un autre rôle (fournisseur, admin, etc.)
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Welcome Page</title>
                </head>
                <body>
                    <h1>Welcome, ' . htmlspecialchars($username) . '! You are logged in as a ' . htmlspecialchars($user['role']) . '.</h1>
                </body>
                </html>
                ';
                exit();
            }
        } else {
            // Si le mot de passe est incorrect
            echo 'Nom d\'utilisateur ou mot de passe incorrect';
        }
    }
    
    
}
?>
