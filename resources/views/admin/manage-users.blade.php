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
                    <h3>User Management</h3>

                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- User table -->
                    <table class="table-auto w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Role</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                                        @csrf
                                        <td class="border px-4 py-2">
                                            <input type="text" name="name" value="{{ $user->name }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="email" name="email" value="{{ $user->email }}" class="w-full">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <select name="role" class="w-full">
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            </select>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </td>
                                    </form>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
