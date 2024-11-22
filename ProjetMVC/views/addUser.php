<?php
require_once __DIR__ . '/../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'number' => $_POST['number'],
        'role' => $_POST['role'],
    ];

    // Ajouter l'utilisateur dans la base de données
    $response = $userController->addUser($data);

    // Si l'ajout est réussi, renvoyer la nouvelle ligne HTML du tableau
    echo $response;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In / Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #c0ffd8;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 500px;
            max-width: 200%;
            min-height: 600px;
            transition: background 0.3s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container.active {
             background: radial-gradient(circle, #004d00, #001a00);

            background-size: cover;
        }

        .container.inactive {
            background: url('plant.jpg') no-repeat center center;
            background-size: cover;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            right: 0;
            transform: translateX(0);
        }

        .sign-up {
            left: 0;
            transform: translateX(-100%);
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .container.active .sign-up {
            transform: translateX(0);
        }
        .role-selection {
    display: flex;
    justify-content: flex-start; /* Garder l'alignement à gauche */
    width: 110%;
    max-width: 400px;
    align-items: center;
}

.role-selection label {
    margin: 0 5px;
}

.role-selection input[type="radio"] {
    margin: 0 5px;
    transform: scale(1.2);
}

/* Pas besoin de changer "margin-left" si vous voulez Fournisseur à gauche et Client à côté */


        form {
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 50px;
            height: 100%;
            text-align: center;
            border-radius: 15px;
        }

        form h2 {
            margin: 10px 0;
        }

        form input {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            border: none;
            background-color: #157237;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        .toggle-container {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .toggle-container button {
            padding: 10px 20px;
            border: none;
            background-color: #b7ffcb;
            color: rgb(0, 0, 0);
            border-radius: 20px;
            cursor: pointer;
        }

        .toggle-container button:hover {
            background-color: #333;
            color: #fff;
        }

        button.hide {
            display: none;
        }
    </style>
</head>
<body>


<div class="wrapper">
    <div class="container inactive" id="container">
        <div class="form-container sign-up">
        <form method="POST" action="">
    <h2>Create Account</h2>
    <input type="text" id="nom" name="nom" placeholder="Nom" required>
    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
    <input type="number" id="number" name="number" placeholder="Numéro de téléphone" required>
    <label for="role">Rôle:</label><br>
    <div class="role-selection">
        <label for="fournisseur">Fournisseur</label>
        <input type="radio" id="fournisseur" name="role" value="fournisseur">
        
        <label for="client">Client</label>
        <input type="radio" id="client" name="role" value="client" required>
    </div>
    <button type="submit">Sign Up</button>
</form>

        </div>
        <div class="form-container sign-in">
        <form method="POST" action="UserController.php?action=signin">
    <h2>Sign In</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">login in</button>
</form>

        </div>
        <div class="toggle-container">
            <button id="register">Sign Up</button>
            <button id="login" class="hide">Sign In</button>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById("container");
    const registerBtn = document.getElementById("register");
    const loginBtn = document.getElementById("login");

    registerBtn.addEventListener("click", () => {
        container.classList.add("active");
        registerBtn.classList.add("hide");
        loginBtn.classList.remove("hide");
    });

    loginBtn.addEventListener("click", () => {
        container.classList.remove("active");
        loginBtn.classList.add("hide");
        registerBtn.classList.remove("hide");
    });
</script>
</body>
</html>
