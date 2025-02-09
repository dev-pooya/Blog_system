<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Core\Auth;

class AdminController extends Controller
{
    private Post $postModel;
    private User $userModel;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->userModel = new User();
    }

    public function dashboard(): void
    {
        $this->view('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'posts' => $this->postModel->findAll(),
            'users' => $this->userModel->findAll()
        ]);
    }

    public function createPost(): void
    {
        $this->view('admin/posts/create', [
            'title' => 'Create Post'
        ]);
    }

    public function storePost(): void
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($title) || empty($content)) {
            $_SESSION['error'] = 'All fields are required';
            $this->redirect('/admin/posts/create');
            return;
        }

        $created = $this->postModel->create([
            'title' => $title,
            'content' => $content,
            'user_id' => Auth::id()
        ]);

        if ($created) {
            $_SESSION['success'] = 'Post created successfully';
            $this->redirect('/admin');
        } else {
            $_SESSION['error'] = 'Failed to create post';
            $this->redirect('/admin/posts/create');
        }
    }

    public function editPost(int $id): void
    {
        $post = $this->postModel->findById($id);
        
        if (!$post) {
            $_SESSION['error'] = 'Post not found';
            $this->redirect('/admin');
            return;
        }

        $this->view('admin/posts/edit', [
            'title' => 'Edit Post',
            'post' => $post
        ]);
    }

    public function updatePost(int $id): void
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($title) || empty($content)) {
            $_SESSION['error'] = 'All fields are required';
            $this->redirect("/admin/posts/{$id}/edit");
            return;
        }

        $updated = $this->postModel->update($id, [
            'title' => $title,
            'content' => $content
        ]);

        if ($updated) {
            $_SESSION['success'] = 'Post updated successfully';
            $this->redirect('/admin');
        } else {
            $_SESSION['error'] = 'Failed to update post';
            $this->redirect("/admin/posts/{$id}/edit");
        }
    }

    public function deletePost(int $id): void
    {
        if ($this->postModel->delete($id)) {
            $_SESSION['success'] = 'Post deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete post';
        }
        
        $this->redirect('/admin');
    }

    public function users(): void
    {
        $this->view('admin/users/index', [
            'title' => 'Manage Users',
            'users' => $this->userModel->findAll()
        ]);
    }

    public function toggleAdmin(int $id): void
    {
        if ($this->userModel->toggleAdmin($id)) {
            $_SESSION['success'] = 'User role updated successfully';
        } else {
            $_SESSION['error'] = 'Failed to update user role';
        }
        
        $this->redirect('/admin/users');
    }

    public function deleteUser(int $id): void
    {
        if ($this->userModel->delete($id)) {
            $_SESSION['success'] = 'User deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete user';
        }
        
        $this->redirect('/admin/users');
    }
} 