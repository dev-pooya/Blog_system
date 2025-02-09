<?php

namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    private Post $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function show(string $slug): void
    {
        $post = $this->postModel->findBySlug($slug);
        
        if (!$post) {
            http_response_code(404);
            $this->view('errors/404', ['title' => 'Post Not Found']);
            return;
        }

        $this->view('posts/show', [
            'title' => $post['title'],
            'post' => $post
        ]);
    }
} 