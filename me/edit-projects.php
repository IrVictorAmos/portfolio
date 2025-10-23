<?php
require_once '../functions/auth.php';
require_once '../classes/PortfolioManager.php';
require_once '../config.php';

requireLogin();

$portfolioManager = new PortfolioManager($conn);

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_project'])) {
        $data = [
            'title' => trim($_POST['title']),
            'description' => trim($_POST['description']),
            'image_url' => trim($_POST['image_url']),
            'project_url' => trim($_POST['project_url'])
        ];
        if ($portfolioManager->addProject($data)) {
            $message = 'Projet ajouté avec succès.';
        } else {
            $message = 'Erreur lors de l\'ajout du projet.';
        }
    } elseif (isset($_POST['delete_project'])) {
        $id = (int)$_POST['project_id'];
        if ($portfolioManager->deleteProject($id)) {
            $message = 'Projet supprimé avec succès.';
        } else {
            $message = 'Erreur lors de la suppression du projet.';
        }
    }
}

$projects = $portfolioManager->getProjects();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les projets - Gestion Portfolio</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .edit-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }
        .project-form, .project-list {
            margin-bottom: 30px;
        }
        .project-form input, .project-form textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .project-form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .project-form button:hover {
            background-color: #218838;
        }
        .project-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .project-info h3 {
            margin: 0 0 5px 0;
        }
        .project-info p {
            margin: 5px 0;
            color: #666;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c82333;
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
        <h1>Gérer les projets</h1>
        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'succès') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="project-form">
            <h2>Ajouter un nouveau projet</h2>
            <form method="POST" action="">
                <input type="text" name="title" placeholder="Titre du projet" required>
                <textarea name="description" placeholder="Description du projet" rows="3"></textarea>
                <input type="url" name="image_url" placeholder="URL de l'image">
                <input type="url" name="project_url" placeholder="URL du projet">
                <button type="submit" name="add_project">Ajouter le projet</button>
            </form>
        </div>

        <div class="project-list">
            <h2>Projets existants</h2>
            <?php if (empty($projects)): ?>
                <p>Aucun projet trouvé.</p>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <div class="project-item">
                        <div class="project-info">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <?php if ($project['image_url']): ?>
                                <p><strong>Image:</strong> <?php echo htmlspecialchars($project['image_url']); ?></p>
                            <?php endif; ?>
                            <?php if ($project['project_url']): ?>
                                <p><strong>URL:</strong> <a href="<?php echo htmlspecialchars($project['project_url']); ?>" target="_blank"><?php echo htmlspecialchars($project['project_url']); ?></a></p>
                            <?php endif; ?>
                        </div>
                        <form method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">
                            <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                            <button type="submit" name="delete_project" class="delete-btn">Supprimer</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>