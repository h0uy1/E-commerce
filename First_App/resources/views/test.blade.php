@extends('app')
@section('content')
    <h1>Webhook Request Data</h1>

    <pre>
        Headers:
        {{ print_r($requestData['headers']) }}

        Body:
        {{ $requestData['body'] }}
    </pre>
@endsection