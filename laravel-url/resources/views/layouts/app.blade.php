<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
    <style>
        body { font-family: Arial; padding:20px; }
        nav a { margin-right:15px; }
    </style>
</head>
<body>

<h1>URL Shortener</h1>

<nav>
    @auth
        <p>Logged in as: <b>{{ auth()->user()->name }}</b> (role: {{ auth()->user()->role }})</p>

        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('urls.index') }}">Short URLs</a>
        <a href="{{ route('companies.index') }}">Companies</a>
        <a href="{{ route('users.index') }}">Users</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
</nav>

<hr>

<div>
    @yield('content')
</div>

</body>
</html>
