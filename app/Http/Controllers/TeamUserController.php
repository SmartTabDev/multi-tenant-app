<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeamUserController extends Controller
{
    public function index()
    {
        return view('team-user.dashboard');
    }

    // View All Team Products (with search/filter)
    public function products(Request $request)
    {
        $team = auth()->user()->team;
        
        if (!$team) {
            return redirect()->route('team-user.dashboard')->with('error', 'You are not assigned to a team.');
        }
        
        $query = $team->products()->with(['category', 'user']);
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Filter by creator
        if ($request->filled('creator')) {
            if ($request->creator === 'me') {
                $query->where('user_id', auth()->id());
            } else {
                $query->where('user_id', $request->creator);
            }
        }
        
        $products = $query->latest()->get();
        $categories = Category::all();
        $teamUsers = $team->users;
        
        return view('team-user.products.index', compact('products', 'categories', 'teamUsers', 'team'));
    }

    // My Products (own products only)
    public function myProducts()
    {
        $products = auth()->user()->products()->with('category')->latest()->get();
        
        return view('team-user.my-products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('team-user.my-products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $team = auth()->user()->team;
        
        if (!$team) {
            return redirect()->route('team-user.dashboard')->with('error', 'You are not assigned to a team.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
            'stock' => 'required|integer|min:0',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        $validated['team_id'] = $team->id;
        $validated['user_id'] = auth()->id();
        
        Product::create($validated);
        
        return redirect()->route('team-user.my-products')->with('success', 'Product created successfully!');
    }

    public function editProduct(Product $product)
    {
        // Ensure product belongs to the current user
        if ($product->user_id !== auth()->id()) {
            return redirect()->route('team-user.my-products')->with('error', 'You can only edit your own products.');
        }
        
        $categories = Category::all();
        
        return view('team-user.my-products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        // Ensure product belongs to the current user
        if ($product->user_id !== auth()->id()) {
            return redirect()->route('team-user.my-products')->with('error', 'You can only edit your own products.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'stock' => 'required|integer|min:0',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug (except for current product)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Product::where('slug', $validated['slug'])->where('id', '!=', $product->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        $product->update($validated);
        
        return redirect()->route('team-user.my-products')->with('success', 'Product updated successfully!');
    }

    public function destroyProduct(Product $product)
    {
        // Ensure product belongs to the current user
        if ($product->user_id !== auth()->id()) {
            return redirect()->route('team-user.my-products')->with('error', 'You can only delete your own products.');
        }
        
        $product->delete();
        
        return redirect()->route('team-user.my-products')->with('success', 'Product deleted successfully!');
    }

    // Categories (Read-only)
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        
        return view('team-user.categories.index', compact('categories'));
    }
}