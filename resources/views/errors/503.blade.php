@extends('template.layout')
@section('content')

    <div id="box" class="col-md-12">
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h1>Error code 503</h1>
                <p>We will be back soon</p>
                <a class="btn btn-primary" href="{{ url('/') }}">Try Again</a>
            </div>
        </div>
    </div>

@endsection