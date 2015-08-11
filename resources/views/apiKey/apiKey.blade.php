@extends('app')

@section('content')
    @if (count($key) > 0) 
        @foreach ($key->all() as $key)
            <div>{{ $key }}</div>
        @endforeach
        <button id="recreate-key">Recreate</button>
        <button id="delete-key">Delete</button>
    @else
        <button id="create-key">Create</button>
    @endif
    <input type="hidden" id="auth-token" value="{{ csrf_token() }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/apiKeys.js') }}"></script>
@endsection