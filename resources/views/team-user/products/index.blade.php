@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-pink-50 to-fuchsia-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-700 via-fuchsia-600 to-pink-600 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Browse Team Products</h1>
            <p class="mt-2 text-purple-100">View all products in {{ $team->name }}</p>
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

        <!-- Search and Filter Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-4 border-purple-200">
            <form action="{{ route('team-user.products') }}" method="GET" class="space-y-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        Search Products
                    </label>
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        value="{{ request('search') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="Search by name, description, or SKU..."
                    >
                </div>

                <!-- Filters -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Category
                        </label>
                        <select 
                            name="category" 
                            id="category" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Creator Filter -->
                    <div>
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-2">
                            Created By
                        </label>
                        <select 
                            name="creator" 
                            id="creator" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        >
                            <option value="">All Users</option>
                            <option value="me" {{ request('creator') === 'me' ? 'selected' : '' }}>My Products</option>
                            @foreach($teamUsers as $user)
                                <option value="{{ $user->id }}" {{ request('creator') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition-colors">
                        Apply Filters
                    </button>
                    <a href="{{ route('team-user.products') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-colors">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Products Count -->
        <div class="mb-4">
            <p class="text-gray-700 font-medium">Found {{ $products->count() }} product(s)</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border-4 border-pink-200 hover:shadow-2xl hover:scale-105 transition-all">
                    <div class="p-6">
                        <!-- Product Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $product->name }}</h3>
                                @if($product->category)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-fuchsia-100 text-fuchsia-800">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-purple-600">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $product->description ?? 'No description available' }}
                            </p>
                        </div>

                        <!-- Product Meta -->
                        <div class="grid grid-cols-2 gap-4 mb-4 p-3 bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg">
                            <div>
                                <p class="text-xs text-gray-500">Stock</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $product->stock }} units</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">SKU</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $product->sku ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Creator Info -->
                        <div class="text-xs text-gray-500">
                            Created by 
                            <span class="font-medium {{ $product->user_id === auth()->id() ? 'text-purple-600' : 'text-gray-700' }}">
                                {{ $product->user->name }}
                                @if($product->user_id === auth()->id())
                                    (You)
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="mt-4 text-gray-500">No products found matching your criteria.</p>
                    <a href="{{ route('team-user.products') }}" class="mt-2 inline-block text-purple-600 hover:text-purple-700 font-medium">
                        Clear filters
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

