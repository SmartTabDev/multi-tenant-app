@extends('layouts.app')

@section('content')
<!-- Team Admin: Fresh green theme with vibrant look -->
<div class="min-h-screen bg-emerald-50">
    <!-- Header with green gradient -->
    <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Team Admin Dashboard</h1>
            <p class="mt-2 text-emerald-50">Manage your team and products</p>
        </div>
    </div>
    
    <!-- Content Area with light green background -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Team Users Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-8 border-emerald-500 hover:shadow-2xl transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-emerald-100 rounded-xl p-4">
                            <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-emerald-700 uppercase tracking-wide mb-2">Team Users</h3>
                    <p class="text-4xl font-bold text-gray-900 mb-1">0</p>
                    <p class="text-sm text-gray-600">Users in your team</p>
                </div>
            </div>
            
            <!-- Products Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-8 border-teal-500 hover:shadow-2xl transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-teal-100 rounded-xl p-4">
                            <svg class="h-8 w-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-teal-700 uppercase tracking-wide mb-2">Products</h3>
                    <p class="text-4xl font-bold text-gray-900 mb-1">0</p>
                    <p class="text-sm text-gray-600">Products in your team</p>
                </div>
            </div>
            
            <!-- Categories Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-8 border-cyan-500 hover:shadow-2xl transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-cyan-100 rounded-xl p-4">
                            <svg class="h-8 w-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-bold text-cyan-700 uppercase tracking-wide mb-2">Categories</h3>
                    <p class="text-4xl font-bold text-gray-900 mb-1">0</p>
                    <p class="text-sm text-gray-600">Product categories</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
