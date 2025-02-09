<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Blog' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="/" class="flex items-center py-4">
                            <span class="font-semibold text-gray-500 text-lg">Blog</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <?php if (\App\Core\Auth::check()): ?>
                        <span class="text-gray-500">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
                        <?php if (\App\Core\Auth::isAdmin()): ?>
                            <a href="/admin" class="py-2 px-4 text-gray-500 hover:text-gray-700">Admin</a>
                        <?php endif; ?>
                        <form action="/logout" method="POST" class="inline">
                            <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">
                                Logout
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="/login" class="py-2 px-4 text-gray-500 hover:text-gray-700">Login</a>
                        <a href="/register" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']) ?>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </main>
</body>
</html> 