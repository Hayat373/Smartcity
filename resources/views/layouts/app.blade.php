<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SmartVillage DePIN') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @auth
            <nav>
                <a href="{{ route('dashboard') }}">Dashboard</a> |
                <a href="{{ route('resources.index') }}">Community Hub</a> |
                <a href="{{ route('resources.predict') }}">AI Prediction</a> |
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </nav>
        @else
            <nav>
                <a href="{{ route('login') }}">Login</a> |
                <a href="{{ route('register') }}">Register</a>
            </nav>
        @endauth
        @yield('content')
    </div>
</body>
</html>