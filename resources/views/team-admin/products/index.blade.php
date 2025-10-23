@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-emerald-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-white">Team Products</h1>
                    <p class="mt-2 text-emerald-50">Manage products for {{ $team->name }}</p>
                </div>
                <a href="{{ route('team-admin.products.create') }}" class="inline-flex items-center px-6 py-3 bg-white hover:bg-emerald-50 text-emerald-700 font-semibold rounded-lg shadow-lg transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Product
                </a>
            </div>
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

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-800 px-6 py-4 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-8 border-teal-500 hover:shadow-2xl transition-shadow">
                    <div class="p-6">
                        <!-- Product Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $product->name }}</h3>
                                @if($product->category)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-cyan-100 text-cyan-800">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-emerald-600">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $product->description ?? 'No description available' }}
                            </p>
                        </div>

                        <!-- Product Meta -->
                        <div class="grid grid-cols-2 gap-4 mb-4 p-3 bg-gray-50 rounded-lg">
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
                        <div class="mb-4 text-xs text-gray-500">
                            Created by <span class="font-medium text-gray-700">{{ $product->user->name }}</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('team-admin.products.edit', $product) }}" class="flex-1 text-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('team-admin.products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="mt-4 text-gray-500">No products found. Create your first product!</p>
                    <a href="{{ route('team-admin.products.create') }}" class="mt-4 inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow-lg transition-colors">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Product
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

