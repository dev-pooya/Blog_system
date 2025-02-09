<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Latest Posts</h1>
        
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($posts as $post): ?>
                <article class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="/posts/<?= htmlspecialchars($post['slug']) ?>" 
                           class="text-blue-600 hover:text-blue-800">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </h2>
                    <p class="text-gray-600 text-sm mb-4">
                        By <?= htmlspecialchars($post['username']) ?> on 
                        <?= date('M j, Y', strtotime($post['created_at'])) ?>
                    </p>
                    <p class="text-gray-700">
                        <?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html> 