<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🧪 Testing Models and Relationships...\n\n";

        // Check if data already exists
        if (Team::count() > 0) {
            echo "⚠️  Test data already exists! Run 'php artisan migrate:fresh' first to reset.\n";
            echo "   Or use existing data to test.\n\n";
            
            $team = Team::first();
            $admin = User::where('role', 'admin')->first();
            $teamAdmin = User::where('role', 'team_admin')->first();
            $teamUser = User::where('role', 'team_user')->first();
            $electronics = Category::where('slug', 'electronics')->first();
            $product = Product::first();
            
            if ($team && $admin && $product) {
                echo "📊 Current Database Stats:\n";
                echo "   - Teams: " . Team::count() . "\n";
                echo "   - Users: " . User::count() . "\n";
                echo "   - Categories: " . Category::count() . "\n";
                echo "   - Products: " . Product::count() . "\n\n";
                
                echo "🎉 You can login with:\n";
                echo "   - Admin: admin@example.com / password\n";
                echo "   - Team Admin: team-admin@example.com / password\n";
                echo "   - Team User: team-user@example.com / password\n";
                return;
            }
        }

        // 1. Create Team
        echo "1️⃣ Creating a Team...\n";
        $team = Team::create([
            'name' => 'Acme Corporation',
            'slug' => 'acme-corp',
            'description' => 'A test company for demo purposes',
        ]);
        echo "   ✅ Team created: {$team->name} (ID: {$team->id})\n\n";

        // 2. Create Users with different roles
        echo "2️⃣ Creating Users...\n";
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'team_id' => null, // Admin doesn't belong to a specific team
        ]);
        echo "   ✅ Admin created: {$admin->name} (Role: {$admin->role})\n";

        $teamAdmin = User::create([
            'name' => 'Team Admin',
            'email' => 'team-admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'team_admin',
            'team_id' => $team->id,
        ]);
        echo "   ✅ Team Admin created: {$teamAdmin->name} (Role: {$teamAdmin->role})\n";

        $teamUser = User::create([
            'name' => 'Team User',
            'email' => 'team-user@example.com',
            'password' => bcrypt('password'),
            'role' => 'team_user',
            'team_id' => $team->id,
        ]);
        echo "   ✅ Team User created: {$teamUser->name} (Role: {$teamUser->role})\n\n";

        // 3. Create Categories
        echo "3️⃣ Creating Categories...\n";
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Electronic devices and gadgets',
        ]);
        echo "   ✅ Category created: {$electronics->name}\n";

        $furniture = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'description' => 'Office and home furniture',
        ]);
        echo "   ✅ Category created: {$furniture->name}\n\n";

        // 4. Create Products
        echo "4️⃣ Creating Products...\n";
        $product1 = Product::create([
            'team_id' => $team->id,
            'category_id' => $electronics->id,
            'user_id' => $teamUser->id,
            'name' => 'Laptop Pro 15',
            'slug' => 'laptop-pro-15',
            'description' => 'A powerful laptop for professionals',
            'price' => 1299.99,
            'sku' => 'LAP-001',
            'stock' => 25,
        ]);
        echo "   ✅ Product created: {$product1->name} (Price: \${$product1->price}, Stock: {$product1->stock})\n";

        $product2 = Product::create([
            'team_id' => $team->id,
            'category_id' => $electronics->id,
            'user_id' => $teamAdmin->id,
            'name' => 'Wireless Mouse',
            'slug' => 'wireless-mouse',
            'description' => 'Ergonomic wireless mouse',
            'price' => 29.99,
            'sku' => 'MOU-001',
            'stock' => 100,
        ]);
        echo "   ✅ Product created: {$product2->name} (Price: \${$product2->price}, Stock: {$product2->stock})\n";

        $product3 = Product::create([
            'team_id' => $team->id,
            'category_id' => $furniture->id,
            'user_id' => $teamUser->id,
            'name' => 'Office Chair',
            'slug' => 'office-chair',
            'description' => 'Comfortable ergonomic office chair',
            'price' => 199.99,
            'sku' => 'CHR-001',
            'stock' => 15,
        ]);
        echo "   ✅ Product created: {$product3->name} (Price: \${$product3->price}, Stock: {$product3->stock})\n\n";

        // 5. Test Relationships
        echo "5️⃣ Testing Relationships...\n";
        echo "   📊 Team '{$team->name}' has {$team->users->count()} users\n";
        echo "   📊 Team '{$team->name}' has {$team->products->count()} products\n";
        echo "   📊 User '{$teamUser->name}' belongs to team: {$teamUser->team->name}\n";
        echo "   📊 User '{$teamUser->name}' created {$teamUser->products->count()} products\n";
        echo "   📊 Product '{$product1->name}' belongs to team: {$product1->team->name}\n";
        echo "   📊 Product '{$product1->name}' belongs to category: {$product1->category->name}\n";
        echo "   📊 Product '{$product1->name}' created by: {$product1->user->name}\n";
        echo "   📊 Category '{$electronics->name}' has {$electronics->products->count()} products\n\n";

        echo "✅ All models and relationships are working correctly!\n";
        echo "🎉 You can now login with:\n";
        echo "   - Admin: admin@example.com / password\n";
        echo "   - Team Admin: team-admin@example.com / password\n";
        echo "   - Team User: team-user@example.com / password\n";
    }
}

