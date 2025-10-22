@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 border-b border-blue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-white">User Management</h1>
                    <p class="mt-2 text-blue-200">Manage users, roles, and team assignments</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back to Dashboard -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-900 border border-green-700 text-green-200 px-6 py-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-900 border border-red-700 text-red-200 px-6 py-4 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Users Table -->
        <div class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-blue-700">
            <table class="min-w-full divide-y divide-slate-700">
                <thead class="bg-slate-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Team</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-750 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->role === 'admin')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-900 text-red-200">
                                        Admin
                                    </span>
                                @elseif($user->role === 'team_admin')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-900 text-blue-200">
                                        Team Admin
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-700 text-gray-200">
                                        Team User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">
                                    {{ $user->team ? $user->team->name : 'No Team' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-400">{{ $user->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-400 hover:text-blue-300 transition-colors">Edit</a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Role Legend -->
        <div class="mt-6 p-4 bg-slate-800 rounded-lg border border-blue-700">
            <h3 class="text-sm font-medium text-blue-300 mb-3">Role Descriptions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-300">
                <div>
                    <span class="font-semibold text-red-300">Admin:</span> Full system access, can manage all teams and users
                </div>
                <div>
                    <span class="font-semibold text-blue-300">Team Admin:</span> Can manage users and products within their team
                </div>
                <div>
                    <span class="font-semibold text-gray-300">Team User:</span> Can create and manage their own products
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

