<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

$db = \App\Core\Database::getInstance();

try {
    // check if admin user already exists
    $stmt = $db->prepare("SELECT * FROM users WHERE email = 'admin@example.com'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        // Create admin user
        $stmt = $db->prepare("
            INSERT INTO users (username, email, password, is_admin)
            VALUES (:username, :email, :password, :is_admin)
        ");
        
        $stmt->execute([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'is_admin' => 1
        ]);
        
        echo "Admin user created successfully!\n";
    } else {
        echo "Admin user already exists!\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 