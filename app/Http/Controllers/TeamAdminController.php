<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeamAdminController extends Controller
{
    public function index()
    {
        return view('team-admin.dashboard');
    }

    // Team User Management
    public function users()
    {
        $team = auth()->user()->team;
        
        if (!$team) {
            return redirect()->route('team-admin.dashboard')->with('error', 'You are not assigned to a team.');
        }
        
        $users = $team->users()->latest()->get();
        
        return view('team-admin.users.index', compact('users', 'team'));
    }

    public function editUser(User $user)
    {
        $team = auth()->user()->team;
        
        // Ensure user belongs to the same team
        if ($user->team_id !== $team->id) {
            return redirect()->route('team-admin.users')->with('error', 'You can only edit users in your team.');
        }
        
        return view('team-admin.users.edit', compact('user', 'team'));
    }

    public function updateUser(Request $request, User $user)
    {
        $team = auth()->user()->team;
        
        // Ensure user belongs to the same team
        if ($user->team_id !== $team->id) {
            return redirect()->route('team-admin.users')->with('error', 'You can only edit users in your team.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:team_admin,team_user',
        ]);
        
        // Keep the same team
        $validated['team_id'] = $team->id;
        
        $user->update($validated);
        
        return redirect()->route('team-admin.users')->with('success', 'User updated successfully!');
    }

    public function removeUser(User $user)
    {
        $team = auth()->user()->team;
        
        // Ensure user belongs to the same team
        if ($user->team_id !== $team->id) {
            return redirect()->route('team-admin.users')->with('error', 'You can only remove users from your team.');
        }
        
        // Prevent removing yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('team-admin.users')->with('error', 'You cannot remove yourself from the team.');
        }
        
        $user->delete();
        
        return redirect()->route('team-admin.users')->with('success', 'User removed successfully!');
    }

    // Product Management
    public function products()
    {
        $team = auth()->user()->team;
        
        if (!$team) {
            return redirect()->route('team-admin.dashboard')->with('error', 'You are not assigned to a team.');
        }
        
        $products = $team->products()->with(['category', 'user'])->latest()->get();
        
        return view('team-admin.products.index', compact('products', 'team'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('team-admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $team = auth()->user()->team;
        
        if (!$team) {
            return redirect()->route('team-admin.dashboard')->with('error', 'You are not assigned to a team.');
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
        
        return redirect()->route('team-admin.products')->with('success', 'Product created successfully!');
    }

    public function editProduct(Product $product)
    {
        $team = auth()->user()->team;
        
        // Ensure product belongs to the same team
        if ($product->team_id !== $team->id) {
            return redirect()->route('team-admin.products')->with('error', 'You can only edit products in your team.');
        }
        
        $categories = Category::all();
        
        return view('team-admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $team = auth()->user()->team;
        
        // Ensure product belongs to the same team
        if ($product->team_id !== $team->id) {
            return redirect()->route('team-admin.products')->with('error', 'You can only edit products in your team.');
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
        
        return redirect()->route('team-admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroyProduct(Product $product)
    {
        $team = auth()->user()->team;
        
        // Ensure product belongs to the same team
        if ($product->team_id !== $team->id) {
            return redirect()->route('team-admin.products')->with('error', 'You can only delete products in your team.');
        }
        
        $product->delete();
        
        return redirect()->route('team-admin.products')->with('success', 'Product deleted successfully!');
    }

    // Categories (Read-only)
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        
        return view('team-admin.categories.index', compact('categories'));
    }
}