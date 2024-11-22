<?php
require_once __DIR__ . '/../controllers/UserController.php';
$userController = new UserController();
$users = $userController->displayUsers();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #43dbb7, #ebf3ef); /* Light green gradient */
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Conteneur principal */
        .container {
            width: 94%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden; /* Prevent overflow */
        }

        /* Conteneur de l'en-tête */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Bouton "Ajouter un utilisateur" */
        .add-user-btn {
            background-color: #10b17e; /* Matching Green Color */
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .add-user-btn:hover {
            background-color: #0f9c6b; /* Slightly darker green */
            transform: translateY(-3px);
        }

        /* Titre de la page */
        h1 {
            text-align: center;
            color: #10b17e; /* Matching Green Color */
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Tableau - Ajout d'un conteneur défilant horizontal */
        .table-container {
            overflow-x: auto; /* Enable horizontal scrolling if needed */
            -webkit-overflow-scrolling: touch;
        }

        /* Tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            min-width: 1000px; /* Ensure enough width for all columns */
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Style des en-têtes du tableau */
        th {
            background-color: #10b17e; /* Matching Green Color */
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Lignes du tableau */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        /* Effet de survol des lignes du tableau */
        tr:hover {
            background-color: #e1f5c4; /* Light Green */
            transform: scale(1.02);
            transition: all 0.3s ease-in-out;
        }

        /* Style des boutons */
        a {
            text-decoration: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            transition: all 0.3s ease;
        }

        /* Bouton de mise à jour */
        a.update-btn {
            background-color: #10b17e; /* Matching Green Color */
        }

        /* Bouton de suppression */
        a.delete-btn {
            background-color: #f44336;
        }

        /* Effet sur les boutons */
        a.update-btn:hover {
            background-color: #0f9c6b; /* Slightly darker green */
        }

        a.delete-btn:hover {
            background-color: #d32f2f;
        }

        /* Mise en forme du tableau vide */
        .empty-table {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #888;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            th, td {
                padding: 12px;
            }
            table {
                font-size: 12px;
            }
            .container {
                width: 90%;
                margin: 20px;
            }
        }

        /* Animation pour les boutons */
        @keyframes bounce {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        .add-user-btn:hover {
            animation: bounce 0.3s ease;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Liste des Utilisateurs</h1>
        <!-- Bouton Ajouter un utilisateur -->
        <a href="index.php?action=addUser" class="add-user-btn">Ajouter un utilisateur</a>
    </div>

    <?php if (empty($users)): ?>
        <div class="empty-table">
            Aucun utilisateur trouvé.
        </div>
    <?php else: ?>
        <!-- Conteneur avec défilement horizontal si nécessaire -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Mot de passe</th>
                        <th>Nom d'utilisateur</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['nom'] ?></td>
                            <td><?= $user['prenom'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['password'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['number'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <!-- Lien vers la page de modification de l'utilisateur -->
                                <a href="/ProjetMVC/index.php?action=updateUser&id=<?= $user['id'] ?>" class="update-btn">Modifier</a>
                                <!-- Lien pour supprimer l'utilisateur -->
                                <a href="/ProjetMVC/views/deleteUser.php?id=<?= $user['id'] ?>" onclick="return confirm('Confirmer la suppression ?')" class="delete-btn">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
