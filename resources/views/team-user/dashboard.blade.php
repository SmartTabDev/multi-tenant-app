@extends('layouts.app')

@section('content')
<!-- Team User: Purple/pink theme with creative design -->
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-pink-50 to-fuchsia-100">
    <!-- Header with purple gradient -->
    <div class="bg-gradient-to-r from-purple-700 via-fuchsia-600 to-pink-600 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Team User Dashboard</h1>
            <p class="mt-2 text-purple-100">View and manage your products</p>
        </div>
    </div>
    
        <!-- Content Area with gradient background -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Quick Actions -->
            <div class="mb-8 flex gap-4 flex-wrap">
                <a href="{{ route('team-user.my-products') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    My Products
                </a>
                <a href="{{ route('team-user.products') }}" class="inline-flex items-center px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Browse All Products
                </a>
                <a href="{{ route('team-user.categories') }}" class="inline-flex items-center px-6 py-3 bg-fuchsia-600 hover:bg-fuchsia-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    View Categories
                </a>
            </div>
            
            <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- My Products Card -->
            <div class="bg-white rounded-3xl shadow-xl p-6 transform hover:scale-105 transition-transform border-4 border-purple-200">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-full p-5 mb-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-purple-700 uppercase tracking-widest mb-2">My Products</h3>
                    <p class="text-5xl font-black text-gray-900 mb-2">{{ auth()->user()->products->count() }}</p>
                    <p class="text-sm text-purple-600 font-medium">Products I created</p>
                </div>
            </div>
            
            <!-- Team Products Card -->
            <div class="bg-white rounded-3xl shadow-xl p-6 transform hover:scale-105 transition-transform border-4 border-pink-200">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-full p-5 mb-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-pink-700 uppercase tracking-widest mb-2">Team Products</h3>
                    <p class="text-5xl font-black text-gray-900 mb-2">{{ auth()->user()->team ? auth()->user()->team->products->count() : 0 }}</p>
                    <p class="text-sm text-pink-600 font-medium">All team products</p>
                </div>
            </div>
            
            <!-- Categories Card -->
            <div class="bg-white rounded-3xl shadow-xl p-6 transform hover:scale-105 transition-transform border-4 border-fuchsia-200">
                <div class="flex flex-col items-center text-center">
                    <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-full p-5 mb-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xs font-bold text-fuchsia-700 uppercase tracking-widest mb-2">Categories</h3>
                    <p class="text-5xl font-black text-gray-900 mb-2">{{ \App\Models\Category::count() }}</p>
                    <p class="text-sm text-fuchsia-600 font-medium">Available categories</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
