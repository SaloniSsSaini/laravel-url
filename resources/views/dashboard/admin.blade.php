@extends('layouts.app')

@section('content')
<h2>Admin Dashboard</h2>

<h3>Your Company: {{ $company->name }}</h3>

<h3>Your Team Members</h3>
<ul>
    @foreach($teamMembers as $member)
        <li>{{ $member->name }} ({{ $member->role }})</li>
    @endforeach
</ul>

<a href="/invite">Invite User</a>

@endsection
