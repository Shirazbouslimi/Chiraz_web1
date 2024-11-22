<?php
require_once __DIR__ . '/../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Créez une instance de votre contrôleur utilisateur
    $userController = new UserController();

    // Recherchez l'utilisateur dans la table `clients`
    $client = $userController->getUserByUsername($username);

    if ($client && password_verify($password, $client['password'])) {
        // Vérifiez le rôle et redirigez en conséquence
        if ($client['role'] === 'client') {
            header('Location: home1.html');
        } elseif ($client['role'] === 'fournisseur') {
            header('Location: home2.html');
        } else {
            echo "Rôle inconnu.";
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
    exit();
}
?>
