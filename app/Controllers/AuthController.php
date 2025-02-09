<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Auth;

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function loginForm(): void
    {
        if (Auth::check()) {
            $this->redirect('/');
            return;
        }
        $this->view('auth/login');
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid email or password';
            $this->redirect('/login');
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['username'] = $user['username'];

        $this->redirect('/');
    }

    public function registerForm(): void
    {
        if (Auth::check()) {
            $this->redirect('/');
            return;
        }
        $this->view('auth/register');
    }

    public function register(): void
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validation
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'All fields are required';
            $this->redirect('/register');
            return;
        }

        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match';
            $this->redirect('/register');
            return;
        }

        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already exists';
            $this->redirect('/register');
            return;
        }

        $success = $this->userModel->create([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        if ($success) {
            $_SESSION['success'] = 'Registration successful! Please login.';
            $this->redirect('/login');
        } else {
            $_SESSION['error'] = 'Registration failed';
            $this->redirect('/register');
        }
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }
} 