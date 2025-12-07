@extends('layouts.app')

@section('content')
<h2>Short URLs</h2>

<ul>
@foreach($shortUrls as $url)
    <li>
        {{ $url->short_code }} → {{ $url->original_url }}
        | Company: {{ $url->company->name }}
        | Created By: {{ $url->creator->name }}
    </li>
@endforeach
</ul>

@endsection
