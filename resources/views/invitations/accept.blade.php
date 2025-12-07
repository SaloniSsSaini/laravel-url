@extends('layouts.app')

@section('content')
<h2>Accept Invitation</h2>

<form method="POST" action="/invite/accept">
    @csrf

    <label>Name</label>
    <input type="text" name="name" required><br><br>

    <label>Password</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Create Account</button>
</form>

@endsection
