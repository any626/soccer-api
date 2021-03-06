@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Api Key</div>
                <div class="panel-body" id="key-panel">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <input type="hidden" name="_token" id="auth-token" value="{{ csrf_token() }}">

                        @if(count($key) > 0)
                            <div class="form-group">
                                <div class="col-md-12" id="key-container">
                                    <pre id="key">{{ $key[0]['api_key'] }}</pre>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4" id="button-group">
                                    <button class="btn btn-primary" id="recreate-key">Reset</button>
                                    <button class="btn btn-primary" id="delete-key">Delete</button>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <div class="col-md-12" id="key-container">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4" id="button-group">
                                    <button type="submit" class="btn btn-primary" id="create-key">
                                        Create a Key
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/apiKeys.js') }}"></script>
@endsection