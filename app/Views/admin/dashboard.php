<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Admin Dashboard</h1>
        <div class="space-x-4">
            <a href="/admin/users" 
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Manage Users
            </a>
            <a href="/admin/posts/create" 
               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Create New Post
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Posts</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td class="px-6 py-4"><?= htmlspecialchars($post['title']) ?></td>
                            <td class="px-6 py-4"><?= date('M j, Y', strtotime($post['created_at'])) ?></td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="/admin/posts/<?= $post['id'] ?>/edit" 
                                   class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="/admin/posts/<?= $post['id'] ?>/delete" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Are you sure?')">
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 