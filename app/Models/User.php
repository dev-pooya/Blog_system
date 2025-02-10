<?php

namespace App\Models;

use App\Core\Auth;

class User extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (username, email, password, is_admin)
            VALUES (:username, :email, :password, :is_admin)
        ");
        
        return $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => $data['is_admin'] ?? 0
        ]);
    }

    public function toggleAdmin(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET is_admin = CASE WHEN is_admin = 1 THEN 0 ELSE 1 END
            WHERE id = ? AND id != ?
        ");
        // prevent toggling the main admin account
        return $stmt->execute([$id, Auth::id()]);
    }

    public function delete(int $id): bool
    {
        // Prevent deleting the main admin account
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ? AND id != ?");
        return $stmt->execute([$id, Auth::id()]);
    }
} 