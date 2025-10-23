@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-emerald-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Product Categories</h1>
            <p class="mt-2 text-emerald-50">View all available product categories</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back to Dashboard -->
        <div class="mb-6">
            <a href="{{ route('team-admin.dashboard') }}" class="inline-flex items-center text-emerald-700 hover:text-emerald-600 transition-colors font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Info Box -->
        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-lg">
            <p class="text-sm text-blue-800">
                <strong>Note:</strong> Categories are managed by system administrators. You can view and assign categories to your products.
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-8 border-cyan-500 hover:shadow-2xl transition-shadow">
                    <div class="p-6">
                        <!-- Category Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-cyan-100 rounded-full p-4">
                                <svg class="h-8 w-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    {{ $category->products_count }} products
                                </span>
                            </div>
                        </div>

                        <!-- Category Name -->
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                        
                        <!-- Category Description -->
                        <p class="text-sm text-gray-600 mb-4">
                            {{ $category->description ?? 'No description available' }}
                        </p>

                        <!-- Category Slug -->
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-500">
                                <strong>Slug:</strong> {{ $category->slug }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <p class="mt-4 text-gray-500">No categories available yet.</p>
                    <p class="mt-2 text-sm text-gray-400">Contact your administrator to add categories.</p>
                </div>
            @endforelse
        </div>

        <!-- Summary Card -->
        @if($categories->count() > 0)
            <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 border-l-8 border-emerald-500">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Categories Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-emerald-50 rounded-lg">
                        <p class="text-3xl font-bold text-emerald-600">{{ $categories->count() }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total Categories</p>
                    </div>
                    <div class="text-center p-4 bg-teal-50 rounded-lg">
                        <p class="text-3xl font-bold text-teal-600">{{ $categories->sum('products_count') }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total Products</p>
                    </div>
                    <div class="text-center p-4 bg-cyan-50 rounded-lg">
                        <p class="text-3xl font-bold text-cyan-600">{{ $categories->count() > 0 ? number_format($categories->sum('products_count') / $categories->count(), 1) : 0 }}</p>
                        <p class="text-sm text-gray-600 mt-1">Avg Products/Category</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

