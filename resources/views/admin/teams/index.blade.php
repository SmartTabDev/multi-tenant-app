@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 border-b border-blue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-white">Team Management</h1>
                    <p class="mt-2 text-blue-200">Create and manage teams</p>
                </div>
                <a href="{{ route('admin.teams.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Team
                </a>
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

        <!-- Teams Table -->
        <div class="bg-slate-800 rounded-lg shadow-xl overflow-hidden border border-blue-700">
            <table class="min-w-full divide-y divide-slate-700">
                <thead class="bg-slate-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Team Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Users</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Products</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($teams as $team)
                        <tr class="hover:bg-slate-750 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $team->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-blue-300">{{ $team->slug }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300">{{ Str::limit($team->description, 50) ?? 'No description' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900 text-green-200">
                                    {{ $team->users_count }} users
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-900 text-purple-200">
                                    {{ $team->products_count }} products
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.teams.edit', $team) }}" class="text-blue-400 hover:text-blue-300 transition-colors">Edit</a>
                                    <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this team?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                No teams found. Create your first team!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

