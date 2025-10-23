<?php
// Inclure les fonctions d'authentification
require_once '../functions/auth.php';

// Vérifier la connexion
requireLogin();

// Traiter la déconnexion
if (isset($_GET['logout'])) {
    logout();
    header("Location: login.php");
    exit();
}

$user = getCurrentUser();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion Portfolio</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .dashboard-menu {
            list-style: none;
            padding: 0;
        }
        .dashboard-menu li {
            margin: 10px 0;
        }
        .dashboard-menu a {
            display: block;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-decoration: none;
            color: #333;
        }
        .dashboard-menu a:hover {
            background-color: #e9ecef;
        }
        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Tableau de bord</h1>
            <div>
                <span>Connecté en tant que: <?php echo htmlspecialchars($user['username']); ?></span>
                <a href="?logout" class="logout-btn">Déconnexion</a>
            </div>
        </div>

        <h2>Gestion du portfolio</h2>
        <ul class="dashboard-menu">
            <li><a href="edit-about.php">Modifier la section À propos</a></li>
            <li><a href="edit-projects.php">Gérer les projets</a></li>
            <li><a href="edit-skills.php">Modifier les compétences</a></li>
            <li><a href="view-stats.php">Voir les statistiques de visites</a></li>
        </ul>
    </div>
</body>
</html>