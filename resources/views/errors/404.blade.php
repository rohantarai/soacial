@extends('template.layout')
@section('content')

    <div id="box" class="col-md-12">
        <div class="container-fluid">
            <div class="jumbotron text-center">
                <h2>Error code 404</h2>
                <p>The Page you are looking for doesn't exist</p>
                <a class="btn btn-primary" href="{{ url('/') }}">Go Back</a>
            </div>
        </div>
    </div>

@endsection