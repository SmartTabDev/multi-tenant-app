@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-pink-50 to-fuchsia-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-700 via-fuchsia-600 to-pink-600 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Product Categories</h1>
            <p class="mt-2 text-purple-100">View all available product categories</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back to Dashboard -->
        <div class="mb-6">
            <a href="{{ route('team-user.dashboard') }}" class="inline-flex items-center text-purple-700 hover:text-purple-600 transition-colors font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Info Box -->
        <div class="mb-6 p-4 bg-purple-100 border-l-4 border-purple-600 rounded-lg">
            <p class="text-sm text-purple-900">
                <strong>Note:</strong> Categories are managed by system administrators. You can assign categories to your products.
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border-4 border-fuchsia-200 hover:shadow-2xl hover:scale-105 transition-all">
                    <div class="p-6">
                        <!-- Category Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-fuchsia-100 rounded-full p-4">
                                <svg class="h-8 w-8 text-fuchsia-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
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
            <div class="mt-8 bg-white rounded-3xl shadow-xl p-6 border-4 border-purple-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Categories Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg">
                        <p class="text-3xl font-bold text-purple-600">{{ $categories->count() }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total Categories</p>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-pink-50 to-pink-100 rounded-lg">
                        <p class="text-3xl font-bold text-pink-600">{{ $categories->sum('products_count') }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total Products</p>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-fuchsia-50 to-fuchsia-100 rounded-lg">
                        <p class="text-3xl font-bold text-fuchsia-600">{{ $categories->count() > 0 ? number_format($categories->sum('products_count') / $categories->count(), 1) : 0 }}</p>
                        <p class="text-sm text-gray-600 mt-1">Avg Products/Category</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

