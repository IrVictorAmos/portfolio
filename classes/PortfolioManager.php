<?php
/**
 * Classe pour la gestion du contenu du portfolio
 * Cette classe gère les sections À propos, projets et compétences
 */
class PortfolioManager {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Obtenir le contenu de la section À propos
     * @return string Contenu de la section
     */
    public function getAbout() {
        $query = "SELECT content FROM about ORDER BY updated_at DESC LIMIT 1";
        $result = $this->conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['content'];
        }
        return '';
    }

    /**
     * Mettre à jour le contenu de la section À propos
     * @param string $content Nouveau contenu
     * @return bool Succès de la mise à jour
     */
    public function updateAbout($content) {
        $query = "INSERT INTO about (content) VALUES (?) ON DUPLICATE KEY UPDATE content = VALUES(content), updated_at = CURRENT_TIMESTAMP";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("s", $content);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Obtenir tous les projets
     * @return array Liste des projets
     */
    public function getProjects() {
        $query = "SELECT * FROM projects ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        $projects = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $projects[] = $row;
            }
        }
        return $projects;
    }

    /**
     * Ajouter un projet
     * @param array $data Données du projet
     * @return bool Succès de l'ajout
     */
    public function addProject($data) {
        $query = "INSERT INTO projects (title, description, image_url, project_url) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ssss", $data['title'], $data['description'], $data['image_url'], $data['project_url']);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Mettre à jour un projet
     * @param int $id ID du projet
     * @param array $data Données du projet
     * @return bool Succès de la mise à jour
     */
    public function updateProject($id, $data) {
        $query = "UPDATE projects SET title = ?, description = ?, image_url = ?, project_url = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ssssi", $data['title'], $data['description'], $data['image_url'], $data['project_url'], $id);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Supprimer un projet
     * @param int $id ID du projet
     * @return bool Succès de la suppression
     */
    public function deleteProject($id) {
        $query = "DELETE FROM projects WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Obtenir toutes les compétences
     * @return array Liste des compétences
     */
    public function getSkills() {
        $query = "SELECT * FROM skills ORDER BY category, name";
        $result = $this->conn->query($query);
        $skills = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $skills[] = $row;
            }
        }
        return $skills;
    }

    /**
     * Ajouter une compétence
     * @param array $data Données de la compétence
     * @return bool Succès de l'ajout
     */
    public function addSkill($data) {
        $query = "INSERT INTO skills (name, level, category) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sis", $data['name'], $data['level'], $data['category']);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Mettre à jour une compétence
     * @param int $id ID de la compétence
     * @param array $data Données de la compétence
     * @return bool Succès de la mise à jour
     */
    public function updateSkill($id, $data) {
        $query = "UPDATE skills SET name = ?, level = ?, category = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sisi", $data['name'], $data['level'], $data['category'], $id);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Supprimer une compétence
     * @param int $id ID de la compétence
     * @return bool Succès de la suppression
     */
    public function deleteSkill($id) {
        $query = "DELETE FROM skills WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }
}
?>