<?php

namespace App\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    private Post $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index(): void
    {
        $posts = $this->postModel->getLatestPosts();
        $this->view('home/index', ['posts' => $posts]);
    }
} 