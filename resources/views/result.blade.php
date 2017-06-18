{{--
@extends('template.layout')
@section('content')

    @include('template.search')

    <div class="container">
            @if(!$users->count())
                <div class="alert alert-danger" role="alert">
                    <p>No Results</p>
                </div>
            @else
            @foreach($users as $user)
            <div class="col-md-3 col-sm-4">
                <div class="thumbnail">
                    @if(!is_null($user->usersInfo->avatar))
                        <a href="{{ route('profile',['regno' => $user->reg_no]) }}" target="_blank">
                            <img src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}"/>
                        </a>
                    @else
                        <a href="{{ route('profile',['regno' => $user->reg_no]) }}" target="_blank">
                            <img src="{{ asset('/uploads/avatars/default.jpg') }}"/>
                        </a>
                    @endif
                    <div class="caption">
                        <h3>{{ $user->full_name }}</h3>
                        <h6>{{ $user->institutes->name }}</h6>
                        <h6>{{ $user->usersInfo->academicYear_from }} - {{ $user->usersInfo->academicYear_to }}</h6>
                        <p><a href="{{ route('profile',['regno' => $user->reg_no]) }}" class="btn btn-primary btn-xs" role="button" style="border-radius:50px">View Profile</a> <a href="#" class="btn btn-default btn-xs" role="button" style="border-radius:50px">Button</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
    </div>
    <div class="container text-center">
        {{ $users->appends(request()->input())->links() }}
    </div>

@endsection--}}
