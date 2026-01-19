<?php
namespace App\core;

use Pdo;
use PDOException;

class Database
{
    private static $instance = null;
    private $connection;

    /**
     * Constructeur privé pour empêcher l'instanciation directe
     */
    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            
            throw new \Exception("Database connection failed. Please try again later.");
        }
    }

    /**
     * Empêche le clonage de l'instance
     */
    private function __clone() {}

    /**
     * Récupère l'instance unique de Database
     * @return Database
     */
    public static function getInstance()
    {
        require_once __DIR__ . '/../../config/config.php';

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Récupère la connexion PDO
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Prépare et exécute une requête
     * @param string $sql
     * @param array $params
     * @return PDOStatement
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

        /**
     * Empêche la désérialisation
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
