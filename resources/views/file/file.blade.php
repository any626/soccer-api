@extends('app')

@section('content')
    <form action="/file/upload" method="post" enctype="multipart/form-data">
        <input type="hidden" id="auth-token" name="_token" value="{{ csrf_token() }}">
        <input type="file" name="file">
        <input type="submit">
    </form>
@endsection

@foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
@endforeach
@if(Session::has('fileError'))
{{{ Session::get('fileError') }}}
@endif
@section('js')
    <script type="text/javascript" src="{{ asset('js/apiKeys.js') }}"></script>
@endsection