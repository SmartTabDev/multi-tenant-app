@extends('layouts.app')

@section('content')
<!-- Admin: Dark blue theme with professional corporate look -->
<div class="min-h-screen bg-slate-900">
    <!-- Header with dark blue gradient -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 border-b border-blue-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Admin Dashboard</h1>
            <p class="mt-2 text-blue-200">System overview and management</p>
        </div>
    </div>
    
    <!-- Content Area with dark background -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Teams Card -->
            <div class="bg-slate-800 border border-blue-700 rounded-lg shadow-xl p-6 hover:bg-slate-750 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-300">Teams</p>
                        <p class="mt-2 text-3xl font-bold text-white">0</p>
                    </div>
                    <div class="bg-blue-600 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-blue-400 font-medium">Total teams</p>
            </div>
            
            <!-- Users Card -->
            <div class="bg-slate-800 border border-green-700 rounded-lg shadow-xl p-6 hover:bg-slate-750 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-300">Users</p>
                        <p class="mt-2 text-3xl font-bold text-white">0</p>
                    </div>
                    <div class="bg-green-600 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-green-400 font-medium">Total users</p>
            </div>
            
            <!-- Products Card -->
            <div class="bg-slate-800 border border-purple-700 rounded-lg shadow-xl p-6 hover:bg-slate-750 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-300">Products</p>
                        <p class="mt-2 text-3xl font-bold text-white">0</p>
                    </div>
                    <div class="bg-purple-600 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-purple-400 font-medium">Total products</p>
            </div>
            
            <!-- Categories Card -->
            <div class="bg-slate-800 border border-orange-700 rounded-lg shadow-xl p-6 hover:bg-slate-750 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-orange-300">Categories</p>
                        <p class="mt-2 text-3xl font-bold text-white">0</p>
                    </div>
                    <div class="bg-orange-600 rounded-full p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-sm text-orange-400 font-medium">Total categories</p>
            </div>
        </div>
    </div>
</div>
@endsection
