<?php

namespace App\core;

use App\core\Session;

/**
 * Classe Security
 * Gère la sécurité : CSRF, XSS, validation
 */

class Security
{

    // Génère un token CSRF

    public function generateCsrfToken(): string
    {
        if (!Session::getInstance()->has('_csrf_token')) {
            $token = bin2hex(random_bytes(32));
            Session::getInstance()->set('_csrf_token', $token);
        }
        return Session::getInstance()->get('_csrf_token');
    }

    // Vérifie le token CSRF

    public function verifyCsrfToken($token)
    {
        $sessionToken = Session::getInstance()->get('_csrf_token');
        if (!$sessionToken || !$token) {
            return false;
        }
        return hash_equals($sessionToken, $token);
    }

    // Nettoie une chaîne contre les attaques XSS

    public static function clean($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }

    /**
     *Nettoie les données contre XSS
     */
    public function sanitize($data)
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }

        return htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Valide et nettoie une email
     */

    public function sanitizeEmail(string $email): string
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    // Hash un mot de passe de manière sécurisée

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Vérifie un mot de passe

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    // Vérifie si l'utilisateur est connecté

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function sanitizeUrl(string $url): string
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * Génère un token aléatoire sécurisé
     */

    public function generateToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Protège contre les injections SQL (à utiliser avec PDO)
     */
    public function escapeString(string $string): string
    {
        return addslashes($string);
    }
}
