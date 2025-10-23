<?php
// Inclure les fonctions d'authentification
require_once '../functions/auth.php';

// Rediriger vers le tableau de bord si connecté
if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

// Traiter le formulaire de connexion
$erreur = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_utilisateur = trim($_POST['username']);
    $mot_de_passe = trim($_POST['password']);

    if (login($nom_utilisateur, $mot_de_passe)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $erreur = 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Portfolio</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../modals.css">
    <style>
        .conteneur-connexion {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .formulaire-connexion input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .formulaire-connexion button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .formulaire-connexion button:hover {
            background-color: #0056b3;
        }
        .erreur {
            color: red;
            margin-bottom: 10px;
        }
        .contenu-principal {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Modal pour le code secret -->
    <div id="modal-code-secret" class="modal active">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Code Secret Requis</h2>
            </div>
            <div class="modal-body">
                <p>Veuillez entrer le code secret pour accéder à la page de connexion.</p>
                <input type="password" id="code-secret-input" placeholder="Entrez le code secret">
                <button id="valider-code">Valider</button>
                <div id="erreur-code" style="color: red; margin-top: 10px;"></div>
            </div>
        </div>
    </div>

    <!-- Contenu principal (formulaire de connexion) -->
    <div id="contenu-principal" class="contenu-principal">
        <div class="conteneur-connexion">
            <h2>Connexion à la gestion du portfolio</h2>
            <?php if ($erreur): ?>
                <div class="erreur"><?php echo htmlspecialchars($erreur); ?></div>
            <?php endif; ?>
            <form class="formulaire-connexion" method="POST" action="">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>

    <script>
        // Code secret d��fini en PHP
        const codeSecret = '<?php echo CODE_SECRET; ?>';

        // Fonction pour valider le code secret
        function validerCodeSecret() {
            const inputCode = document.getElementById('code-secret-input').value;
            const erreurDiv = document.getElementById('erreur-code');

            if (inputCode === codeSecret) {
                // Cacher le modal et afficher le contenu principal
                document.getElementById('modal-code-secret').classList.remove('active');
                document.getElementById('contenu-principal').style.display = 'block';
            } else {
                erreurDiv.textContent = 'Code secret incorrect.';
            }
        }

        // Événement pour le bouton valider
        document.getElementById('valider-code').addEventListener('click', validerCodeSecret);

        // Permettre la validation avec Enter
        document.getElementById('code-secret-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                validerCodeSecret();
            }
        });
    </script>
</body>
</html>