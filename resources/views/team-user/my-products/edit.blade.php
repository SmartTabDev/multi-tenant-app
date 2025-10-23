@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-100 via-pink-50 to-fuchsia-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-700 via-fuchsia-600 to-pink-600 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-4xl font-bold text-white">Edit Product</h1>
            <p class="mt-2 text-purple-100">Update your product information</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('team-user.my-products') }}" class="inline-flex items-center text-purple-700 hover:text-purple-600 transition-colors font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to My Products
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border-4 border-purple-200">
            <form action="{{ route('team-user.my-products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $product->name) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        required
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Category
                    </label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                        <option value="">No Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price and Stock -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                            Price ($) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="price" 
                            id="price" 
                            value="{{ old('price', $product->price) }}"
                            step="0.01"
                            min="0"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            required
                        >
                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                            Stock <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="stock" 
                            id="stock" 
                            value="{{ old('stock', $product->stock) }}"
                            min="0"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            required
                        >
                        @error('stock')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SKU -->
                <div class="mb-6">
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                        SKU (Stock Keeping Unit)
                    </label>
                    <input 
                        type="text" 
                        name="sku" 
                        id="sku" 
                        value="{{ old('sku', $product->sku) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    @error('sku')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Product Info -->
                <div class="mb-6 p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg border-2 border-purple-200">
                    <h3 class="text-sm font-medium text-purple-800 mb-2">Product Information</h3>
                    <div class="text-sm text-purple-700 space-y-1">
                        <p><strong>Created on:</strong> {{ $product->created_at->format('M d, Y') }}</p>
                        <p><strong>Current Slug:</strong> {{ $product->slug }}</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-colors"
                    >
                        Update Product
                    </button>
                    <a 
                        href="{{ route('team-user.my-products') }}" 
                        class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition-colors"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

