<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Admin Section -->
                @if (Auth::user()->role === 'admin')
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Admin Dashboard</h3>
                            <p>Welcome, Admin! Manage users and the application settings.</p>
                            <a href="{{ route('admin.manageUsers') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manage Users</a>
                        </div>
                    </div>
                @endif

                <!-- User Section -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold">{{ Auth::user()->role === 'admin' ? 'Admin Area' : 'User Dashboard' }}</h3>
                        <p>Welcome, {{ Auth::user()->name }}! This is your personal dashboard.</p>
                        <!-- Add user-specific or admin-specific content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
