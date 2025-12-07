@extends('layouts.app')

@section('content')
<h2>Welcome, {{ auth()->user()->name }}</h2>

<p><b>Your Role:</b> {{ auth()->user()->role }}</p>

<p><b>Your Company ID:</b> {{ auth()->user()->company_id ?? '—' }}</p>
@endsection
