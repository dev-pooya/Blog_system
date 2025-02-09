<article class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-8">
    <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
    
    <div class="text-gray-600 mb-4">
        Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?>
    </div>

    <div class="prose max-w-none">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
</article> 