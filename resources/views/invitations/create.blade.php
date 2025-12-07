@extends('layouts.app')

@section('content')
<h2>Invite User</h2>

<form method="POST" action="/invite">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required><br><br>

    <label>Role</label>
    <select name="role" required>
        <option value="SuperAdmin">SuperAdmin</option>
        <option value="Admin">Admin</option>
        <option value="Member">Member</option>
        <option value="Sales">Sales</option>
        <option value="Manager">Manager</option>
    </select><br><br>

    <label>Company</label>
    <select name="company_id">
        <option value="">None</option>
        @foreach($companies as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>

    <br><br>
    <button type="submit">Send Invitation</button>
</form>

@endsection
