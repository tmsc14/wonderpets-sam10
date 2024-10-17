<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">User Management</h3>

                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Search Bar -->
                    <input type="text" placeholder="Search users..." class="mb-4 w-full px-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" />

                    <!-- User table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 dark:text-gray-100 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Name</th>
                                    <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Email</th>
                                    <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Role</th>
                                    <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b dark:border-gray-600">
                                        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                                            @csrf
                                            <td class="border px-4 py-2">
                                                <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2">
                                            </td>
                                            <td class="border px-4 py-2">
                                                <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2">
                                            </td>
                                            <td class="border px-4 py-2">
                                                <select name="role" class="w-full bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2">
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                </select>
                                            </td>
                                            <td class="border px-4 py-2 flex items-center space-x-2">
                                                <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded-md">Update</button>
                                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-2 rounded-md">Delete</button>
                                                </form>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
