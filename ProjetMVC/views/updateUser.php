<?php
// Vérifie si l'utilisateur a été récupéré correctement depuis le contrôleur
if (isset($user)): ?>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un Utilisateur</title>
        <!-- Lien vers le fichier CSS -->
        <link rel="stylesheet" href="/ProjetMVC/views/form.css">
    </head>
    <body>
        <div class="wrapper"> <!-- Use the wrapper class for proper styling -->
            <h2>Modifier l'utilisateur</h2>
            <form action="index.php?action=updateUser&id=<?= $user['id'] ?>" method="POST">
                <!-- Champ Nom -->
                <div class="input-field">
                    <input type="text" name="nom" value="<?= $user['nom'] ?>" required>
                    <label for="nom">Nom:</label>
                </div>

                <!-- Champ Prénom -->
                <div class="input-field">
                    <input type="text" name="prenom" value="<?= $user['prenom'] ?>" required>
                    <label for="prenom">Prénom:</label>
                </div>

                <!-- Champ Email -->
                <div class="input-field">
                    <input type="email" name="email" value="<?= $user['email'] ?>" required>
                    <label for="email">Email:</label>
                </div>

                <!-- Champ Nom d'utilisateur -->
                <div class="input-field">
            <input type="password" id="password" name="password" required>
            <label for="password">Mot de passe:</label>
        </div>
                <div class="input-field">
                    <input type="text" name="username" value="<?= $user['username'] ?>" required>
                    <label for="username">Nom d'utilisateur:</label>
                </div>
                <div class="input-field">
                    <input type="number" name="number" value="<?= $user['number'] ?>" required>
                    <label for="number">Numero de telephone:</label>
                </div>
                

                <!-- Bouton de soumission -->
                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    </body>
    </html>
<?php else: ?>
    <p>L'utilisateur n'existe pas.</p>
<?php endif; ?>
