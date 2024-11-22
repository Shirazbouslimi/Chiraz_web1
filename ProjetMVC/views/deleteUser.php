<?php
// Inclure le contrôleur
require_once __DIR__ . '/../controllers/UserController.php';

// Vérifier si l'ID de l'utilisateur est passé dans l'URL
if (isset($_GET['id'])) {
    $userController = new UserController();
    $id = $_GET['id'];

    // Supprimer l'utilisateur de la base de données
    $userController->deleteUser($id);

    // Rediriger vers la page de la liste des utilisateurs après la suppression
    header("Location: /ProjetMVC/views/displayUsers.php");
    exit();
} else {
    echo "ID d'utilisateur invalide.";
}
?>
