<?php
require_once '../functions/auth.php';
require_once '../classes/PortfolioManager.php';
require_once '../config.php';

requireLogin();

$portfolioManager = new PortfolioManager($conn);

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = trim($_POST['content']);
    if ($portfolioManager->updateAbout($content)) {
        $message = 'Section À propos mise à jour avec succès.';
    } else {
        $message = 'Erreur lors de la mise à jour.';
    }
}

$aboutContent = $portfolioManager->getAbout();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier À propos - Gestion Portfolio</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .edit-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .edit-form textarea {
            width: 100%;
            height: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-family: Arial, sans-serif;
        }
        .edit-form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
        }
        .edit-form button:hover {
            background-color: #218838;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <a href="dashboard.php" class="back-link">&larr; Retour au tableau de bord</a>
        <h1>Modifier la section À propos</h1>
        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'succès') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form class="edit-form" method="POST" action="">
            <textarea name="content" placeholder="Contenu de la section À propos"><?php echo htmlspecialchars($aboutContent); ?></textarea>
            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>