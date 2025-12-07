<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
</head>
<body>

    <nav>
        <a href="/dashboard">Dashboard</a> |
        <a href="/urls">Short URLs</a> |
        <a href="/companies">Companies</a> |
        <a href="/users">Users</a> |
        <a href="/logout">Logout</a>
    </nav>

    <hr>

    <div>
        @yield('content')
    </div>

</body>
</html>
