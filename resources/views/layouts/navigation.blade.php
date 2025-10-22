@php
    $navBgClass = 'bg-white';
    $textClass = 'text-gray-800';
    $subTextClass = 'text-gray-700';
    $linkTextClass = 'text-gray-900';
    $linkHoverClass = 'text-indigo-700';
    $borderClass = 'border-gray-100';
    $borderBottomClass = 'border-indigo-400';
    
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            $navBgClass = 'bg-gradient-to-r from-slate-800 to-blue-900';
            $textClass = 'text-white';
            $subTextClass = 'text-blue-200';
            $linkTextClass = 'text-white';
            $linkHoverClass = 'text-blue-300';
            $borderClass = 'border-blue-700';
            $borderBottomClass = 'border-blue-400';
        } elseif (auth()->user()->role === 'team_admin') {
            $navBgClass = 'bg-gradient-to-r from-emerald-600 to-teal-600';
            $textClass = 'text-white';
            $subTextClass = 'text-emerald-100';
            $linkTextClass = 'text-white';
            $linkHoverClass = 'text-emerald-200';
            $borderClass = 'border-emerald-500';
            $borderBottomClass = 'border-emerald-300';
        } elseif (auth()->user()->role === 'team_user') {
            $navBgClass = 'bg-gradient-to-r from-purple-600 to-pink-600';
            $textClass = 'text-white';
            $subTextClass = 'text-purple-100';
            $linkTextClass = 'text-white';
            $linkHoverClass = 'text-purple-200';
            $borderClass = 'border-purple-500';
            $borderBottomClass = 'border-purple-300';
        }
    }
@endphp

<nav class="{{ $navBgClass }} border-b {{ $borderClass }} shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold {{ $textClass }}">
                        Multi-Tenant SaaS
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ $borderBottomClass }} text-sm font-medium leading-5 {{ $linkTextClass }} focus:outline-none hover:{{ $linkHoverClass }} transition duration-150 ease-in-out">
                                Admin Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'team_admin')
                            <a href="{{ route('team-admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ $borderBottomClass }} text-sm font-medium leading-5 {{ $linkTextClass }} focus:outline-none hover:{{ $linkHoverClass }} transition duration-150 ease-in-out">
                                Team Admin Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'team_user')
                            <a href="{{ route('team-user.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ $borderBottomClass }} text-sm font-medium leading-5 {{ $linkTextClass }} focus:outline-none hover:{{ $linkHoverClass }} transition duration-150 ease-in-out">
                                Team User Dashboard
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm {{ $subTextClass }} font-medium">
                                Welcome, {{ auth()->user()->name }} ({{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }})
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm {{ $subTextClass }} hover:{{ $textClass }} font-medium transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700">Login</a>
                        <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-gray-700">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
