@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 border-b border-blue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Edit User</h1>
            <p class="mt-2 text-blue-200">Update user information, role, and team assignment</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.users') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Users
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-800 rounded-lg shadow-xl p-8 border border-blue-700">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-blue-300 mb-2">
                        Name <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-blue-300 mb-2">
                        Email <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-blue-300 mb-2">
                        Role <span class="text-red-400">*</span>
                    </label>
                    <select 
                        name="role" 
                        id="role" 
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="team_admin" {{ old('role', $user->role) === 'team_admin' ? 'selected' : '' }}>Team Admin</option>
                        <option value="team_user" {{ old('role', $user->role) === 'team_user' ? 'selected' : '' }}>Team User</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400">
                        <strong>Admin:</strong> Full system access | 
                        <strong>Team Admin:</strong> Manage team users & products | 
                        <strong>Team User:</strong> Create own products
                    </p>
                </div>

                <!-- Team Assignment -->
                <div class="mb-6">
                    <label for="team_id" class="block text-sm font-medium text-blue-300 mb-2">
                        Team Assignment
                    </label>
                    <select 
                        name="team_id" 
                        id="team_id" 
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">No Team (Admin only)</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_id', $user->team_id) == $team->id ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('team_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400">Team Admins and Team Users must be assigned to a team. Admins don't need team assignment.</p>
                </div>

                <!-- User Stats -->
                <div class="mb-6 p-4 bg-slate-700 rounded-lg border border-slate-600">
                    <h3 class="text-sm font-medium text-blue-300 mb-3">User Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400">Products Created</p>
                            <p class="text-lg font-semibold text-white">{{ $user->products->count() }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Member Since</p>
                            <p class="text-lg font-semibold text-white">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                @if($user->id === auth()->id())
                    <div class="mb-6 p-4 bg-yellow-900 border border-yellow-700 rounded-lg">
                        <p class="text-sm text-yellow-200">
                            <strong>Note:</strong> You are editing your own account. Be careful when changing your role or team assignment.
                        </p>
                    </div>
                @endif

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-colors"
                    >
                        Update User
                    </button>
                    <a 
                        href="{{ route('admin.users') }}" 
                        class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-semibold rounded-lg transition-colors"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

