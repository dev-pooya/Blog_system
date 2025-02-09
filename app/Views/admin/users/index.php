<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Manage Users</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-6 py-4"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="px-6 py-4">
                                <?= $user['is_admin'] ? 'Admin' : 'User' ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= date('M j, Y', strtotime($user['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <?php if ($user['id'] !== \App\Core\Auth::id()): ?>
                                    <form action="/admin/users/<?= $user['id'] ?>/toggle-admin" 
                                          method="POST" 
                                          class="inline">
                                        <button type="submit" 
                                                class="text-blue-500 hover:text-blue-700">
                                            <?= $user['is_admin'] ? 'Remove Admin' : 'Make Admin' ?>
                                        </button>
                                    </form>
                                    <form action="/admin/users/<?= $user['id'] ?>/delete" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700">
                                            Delete
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 