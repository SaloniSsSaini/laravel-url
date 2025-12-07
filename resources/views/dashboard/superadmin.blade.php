@extends('layouts.app')

@section('content')
<h2>SuperAdmin Dashboard</h2>

<h3>Companies</h3>
<ul>
    @foreach($companies as $c)
        <li>{{ $c->name }} (Users: {{ $c->users_count }})</li>
    @endforeach
</ul>

<h3>All Users</h3>
<ul>
    @foreach($users as $u)
        <li>{{ $u->name }} - {{ $u->email }} - {{ $u->role }}</li>
    @endforeach
</ul>

<a href="/invite">Invite User</a>

@endsection
