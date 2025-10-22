<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Multi-Tenant SaaS Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h1 class="mt-6 text-3xl font-extrabold text-gray-900">Multi-Tenant SaaS Platform</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        A product management platform with role-based access control
                    </p>
                </div>
                
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Features</h2>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-2 w-2 bg-blue-500 rounded-full"></div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-600">Admin: Manage teams and users</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-2 w-2 bg-green-500 rounded-full"></div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-600">Team Admin: Manage team users and products</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-2 w-2 bg-purple-500 rounded-full"></div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-600">Team User: Create and manage products</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="flex-1 bg-indigo-600 text-white text-center py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="flex-1 bg-white text-indigo-600 text-center py-2 px-4 rounded-md border border-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
