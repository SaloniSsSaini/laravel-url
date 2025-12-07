@extends('layouts.app')

@section('content')
<h2>All Users</h2>

@if($users->isEmpty())
    <p>No users found.</p>
@else
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Company</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->company->name ?? '—' }}</td>
        </tr>
    @endforeach
</table>
@endif

@endsection
