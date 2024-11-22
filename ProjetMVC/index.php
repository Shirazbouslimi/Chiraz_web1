<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'addUser';

$userController = new UserController();

switch ($action) {
    case 'addUser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userController->addUser($_POST);
            header('Location: index.php?action=listUsers');
            exit;
        } else {
            require_once __DIR__ . '/views/addUser.php';
        }
        break;

    case 'listUsers':
        $users = $userController->displayUsers();
        require_once __DIR__ . '/views/displayUsers.php';
        break;

    case 'updateUser':
        if (isset($_GET['id'])) {
            $user = $userController->getUser($_GET['id']);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'email' => $_POST['email'],
                    'username' => $_POST['username'],
                    'role' => $_POST['role'],
                ];
                $userController->updateUser($_GET['id'], $data);
                header('Location: index.php?action=listUsers');
                exit;
            }
            require_once __DIR__ . '/views/updateUser.php';
        }
        break;

    default:
        echo "Action non reconnue.";
        break;
}
?>
