<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // Team Management
    public function teams()
    {
        $teams = Team::withCount(['users', 'products'])->latest()->get();
        return view('admin.teams.index', compact('teams'));
    }

    public function createTeam()
    {
        return view('admin.teams.create');
    }

    public function storeTeam(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Team::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        Team::create($validated);

        return redirect()->route('admin.teams')->with('success', 'Team created successfully!');
    }

    public function editTeam(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function updateTeam(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure unique slug (except for current team)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Team::where('slug', $validated['slug'])->where('id', '!=', $team->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        $team->update($validated);

        return redirect()->route('admin.teams')->with('success', 'Team updated successfully!');
    }

    public function destroyTeam(Team $team)
    {
        // Don't allow deleting team if it has users
        if ($team->users()->count() > 0) {
            return redirect()->route('admin.teams')->with('error', 'Cannot delete team with users. Please reassign users first.');
        }

        $team->delete();

        return redirect()->route('admin.teams')->with('success', 'Team deleted successfully!');
    }

    // User Management
    public function users()
    {
        $users = User::with('team')->latest()->get();
        $teams = Team::all();
        return view('admin.users.index', compact('users', 'teams'));
    }

    public function editUser(User $user)
    {
        $teams = Team::all();
        return view('admin.users.edit', compact('user', 'teams'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,team_admin,team_user',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        // If role is admin, team_id should be null
        if ($validated['role'] === 'admin') {
            $validated['team_id'] = null;
        } elseif (empty($validated['team_id'])) {
            // If not admin and no team, require team assignment
            return back()->withErrors(['team_id' => 'Team is required for team_admin and team_user roles.']);
        }

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}