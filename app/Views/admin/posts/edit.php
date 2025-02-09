<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">Edit Post</h1>

    <form action="/admin/posts/<?= $post['id'] ?>" method="POST" class="bg-white rounded-lg shadow p-6">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="title"
                   type="text"
                   name="title"
                   value="<?= htmlspecialchars($post['title']) ?>"
                   required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                Content
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="content"
                      name="content"
                      rows="10"
                      required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                Update Post
            </button>
            <a href="/admin" 
               class="text-gray-500 hover:text-gray-700">
                Cancel
            </a>
        </div>
    </form>
</div> 