<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Admin Dashboard -->
                    @if ($user->role === 'admin')
                        <h3>Admin Dashboard</h3>
                        <p>Welcome, Admin! You have access to administrative functionalities.</p>
                    @else
                        <!-- User Dashboard -->
                        <h3>User Dashboard</h3>
                        <p>Welcome, {{ $user->name }}! This is your personal dashboard.</p>
                        <ul>
                            <li><a href="{{ route('profile.edit') }}" class="btn btn-primary">Manage Profile</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
