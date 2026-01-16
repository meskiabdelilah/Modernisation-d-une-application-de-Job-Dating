<?php
/**
 * Classe Security
 * Gère la sécurité : CSRF, XSS, validation
 */

class Security {
    
    // Génère un token CSRF
     
    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    // Vérifie le token CSRF
    
    public static function verifyCSRFToken($token) {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
    
    // Nettoie une chaîne contre les attaques XSS
     
    public static function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }


    // Hash un mot de passe de manière sécurisée
     
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    // Vérifie un mot de passe
     
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    // Vérifie si l'utilisateur est connecté
     
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

}