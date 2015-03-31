<?php
/**
 * @author Dilshod Sanginov (DELL) <prodilshod@gmail.com>
 * @licenced: (CC) (BY) (NC)
 */
namespace lib;

use \PDO;

class Connector
{
    protected static $instance;
    private $_pdo;

    private function __construct()
    { /* ... @return Singleton */
    }

    private function __clone()
    { /* ... @return Singleton */
    }

    private function __wakeup()
    { /* ... @return Singleton */
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function connect($dsn, $username, $password)
    {

            try {
                $this->_pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            } catch (\PDOException $e) {
                echo $e->getMessage();
                exit;
            }

    }

    /** * @return PDO */
    public function getPDO()
    {
        return $this->_pdo;
    }
}

