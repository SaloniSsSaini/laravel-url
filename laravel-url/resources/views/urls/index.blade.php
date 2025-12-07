@extends('layouts.app')

@section('content')
<h2>All Short URLs</h2>

@if($urls->isEmpty())
    <p>No URLs created yet.</p>
@else
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Original URL</th>
        <th>Short Code</th>
        <th>Created By</th>
    </tr>

    @foreach($urls as $url)
        <tr>
            <td>{{ $url->id }}</td>
            <td>{{ $url->original_url }}</td>
            <td>{{ $url->short_code ?? 'N/A' }}</td>
            <td>{{ $url->creator->name ?? 'Unknown' }}</td>
        </tr>
    @endforeach
</table>
@endif
@endsection
