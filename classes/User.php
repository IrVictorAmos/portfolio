<?php
/**
 * Classe pour la gestion des utilisateurs
 * Cette classe gère l'authentification et les opérations liées aux utilisateurs
 */
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Authentifier un utilisateur avec nom d'utilisateur et mot de passe
     * @param string $username Nom d'utilisateur
     * @param string $password Mot de passe
     * @return array|false Retourne les données utilisateur si authentifié, false sinon
     */
    public function authenticate($username, $password) {
        $query = "SELECT id, username, email, password FROM " . $this->table . " WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    unset($row['password']); // Ne pas retourner le mot de passe
                    return $row;
                }
            }
        }
        return false;
    }

    /**
     * Créer un nouvel utilisateur
     * @param string $username Nom d'utilisateur
     * @param string $password Mot de passe
     * @param string $email Email
     * @return bool Succès de la création
     */
    public function create($username, $password, $email) {
        $query = "INSERT INTO " . $this->table . " (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $username, $hashed_password, $email);
            return $stmt->execute();
        }
        return false;
    }

    /**
     * Vérifier si un utilisateur existe
     * @param string $username Nom d'utilisateur
     * @return bool Existence de l'utilisateur
     */
    public function exists($username) {
        $query = "SELECT id FROM " . $this->table . " WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }
        return false;
    }
}
?>