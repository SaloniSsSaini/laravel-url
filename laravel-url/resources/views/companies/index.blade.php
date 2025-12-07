@extends('layouts.app')

@section('content')

<h2>All Companies</h2>

@if($companies->isEmpty())
    <p>No companies found.</p>
@else
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>

    @foreach($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->name }}</td>
        </tr>
    @endforeach

</table>
@endif

@endsection
