@extends('layouts.app')

@section('content')
<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Create Account</button>
</form>

@if($errors->any())
    <p style="color:red;">{{ $errors->first() }}</p>
@endif

<p>Already have an account? <a href="/login">Login</a></p>
@endsection
