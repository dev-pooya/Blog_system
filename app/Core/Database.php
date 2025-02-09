<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;
    private $connection;

    public function __construct()
    {
        try {
            $dbPath = __DIR__ . '/../../' . $_ENV['DB_PATH'];
            $dbDirectory = dirname($dbPath);

            // Create database directory if it doesn't exist
            if (!is_dir($dbDirectory)) {
                mkdir($dbDirectory, 0777, true);
            }

            $this->connection = new PDO(
                "sqlite:" . $dbPath,
                null,
                null,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );

            // Enable foreign key support
            $this->connection->exec('PRAGMA foreign_keys = ON');
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = (new self())->connection;
        }
        return self::$instance;
    }
} 