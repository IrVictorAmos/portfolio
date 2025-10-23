<?php
require_once '../config.php';
require_once '../classes/User.php';

/**
 * Démarrer une session utilisateur
 */
function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Vérifier si l'utilisateur est connecté
 * @return bool Statut de connexion
 */
function isLoggedIn() {
    startSession();
    return isset($_SESSION['user_id']);
}

/**
 * Connecter un utilisateur
 * @param string $username Nom d'utilisateur
 * @param string $password Mot de passe
 * @return bool Succès de la connexion
 */
function login($username, $password) {
    global $conn;
    $user = new User($conn);
    $userData = $user->authenticate($username, $password);

    if ($userData) {
        startSession();
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['email'] = $userData['email'];
        return true;
    }
    return false;
}

/**
 * Déconnecter l'utilisateur
 */
function logout() {
    startSession();
    session_destroy();
}

/**
 * Rediriger si non connecté
 * @param string $redirectUrl URL de redirection
 */
function requireLogin($redirectUrl = 'login.php') {
    if (!isLoggedIn()) {
        header("Location: $redirectUrl");
        exit();
    }
}

/**
 * Obtenir les informations de l'utilisateur connecté
 * @return array|null Données utilisateur
 */
function getCurrentUser() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email']
        ];
    }
    return null;
}
?>