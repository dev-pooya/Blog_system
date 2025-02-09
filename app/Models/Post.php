<?php

namespace App\Models;

class Post extends Model
{
    protected string $table = 'posts';

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (title, slug, content, user_id)
            VALUES (:title, :slug, :content, :user_id)
        ");
        
        return $stmt->execute([
            'title' => $data['title'],
            'slug' => $this->createSlug($data['title']),
            'content' => $data['content'],
            'user_id' => $data['user_id']
        ]);
    }

    private function createSlug(string $title): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        return $slug;
    }

    public function getLatestPosts(int $limit = 10): array
    {
        $stmt = $this->db->prepare("
            SELECT p.*, u.username 
            FROM {$this->table} p
            LEFT JOIN users u ON p.user_id = u.id
            ORDER BY p.created_at DESC
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET title = :title,
                content = :content,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id
        ");
        
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'content' => $data['content']
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
} 