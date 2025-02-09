# Blog System Documentation

## Features

### Public Features

- View latest blog posts on homepage
- View individual post details
- User registration and login
- Responsive design with Tailwind CSS

### Admin Features

- Secure admin dashboard
- Post Management (Create, Edit, Delete)
- User Management (View, Toggle Admin, Delete)
- Protected admin routes

### Technical Features

- MVC Architecture
- Custom Router with middleware support
- SQLite Database with PDO
- Dependency Injection
- Composer Autoloading

## Setup Instructions

1. **Clone the project**

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Set up environment**

   - Copy `.env.example` to `.env`
   - Update `.env` with your settings

4. **Create database and tables**

   ```bash
   php cli/migrate.php
   ```

5. **Create admin user**

   ```bash
   php database/seeds/AdminSeeder.php
   ```

6. **Start development server**
   ```bash
   php -S localhost:8000 -t public
   ```

## 🔑 Admin Login Credentials

| Field    | Value             |
| -------- | ----------------- |
| Email    | admin@example.com |
| Password | 12345             |
