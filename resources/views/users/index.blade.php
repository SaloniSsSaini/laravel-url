@extends('layouts.app')

@section('content')
<h2>Users</h2>

<ul>
@foreach($users as $u)
    <li>{{ $u->name }} - {{ $u->email }} - {{ $u->role }}</li>
@endforeach
</ul>

@endsection
