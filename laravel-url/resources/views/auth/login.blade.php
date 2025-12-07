@extends('layouts.app')

@section('content')
<h2>Login</h2>

<form method="POST" action="/login">
    @csrf

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

@if($errors->any())
    <p style="color:red;">{{ $errors->first() }}</p>
@endif

<p>
    Don't have an account?
    <a href="/register">Register</a>
</p>
@endsection
