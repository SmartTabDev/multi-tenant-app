@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 border-b border-blue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Create New Team</h1>
            <p class="mt-2 text-blue-200">Add a new team to the system</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.teams') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Teams
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-800 rounded-lg shadow-xl p-8 border border-blue-700">
            <form action="{{ route('admin.teams.store') }}" method="POST">
                @csrf

                <!-- Team Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-blue-300 mb-2">
                        Team Name <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter team name"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400">The slug will be automatically generated from the team name.</p>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-blue-300 mb-2">
                        Description
                    </label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter team description (optional)"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition-colors"
                    >
                        Create Team
                    </button>
                    <a 
                        href="{{ route('admin.teams') }}" 
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

