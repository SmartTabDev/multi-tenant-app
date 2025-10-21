<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="home-container">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div class="dashboard-card">
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-content">
                    Welcome to your Laravel application! This is a clean, modern dashboard 
                    ready for your multi-tenant features.
                </p>
                <div style="margin-top: 2rem; text-align: center;">
                    <a href="{{ url('/') }}" class="welcome-button">Back to Home</a>
                </div>
            </div>
        </div>
    </body>
</html>
