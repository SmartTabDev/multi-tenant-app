@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">Welcome to Multi-Tenant SaaS Platform</h1>
                <p class="mb-4">This is a product management platform with role-based access control.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-blue-800">Admin</h3>
                        <p class="text-blue-600">Manage teams and users</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800">Team Admin</h3>
                        <p class="text-green-600">Manage team users and products</p>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-purple-800">Team User</h3>
                        <p class="text-purple-600">Create and manage products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
