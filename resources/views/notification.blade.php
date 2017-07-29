@extends('template.layout')
@include('template.notifier')
@section('content')

    <div class="container">
        <div class="col-md-6">
            @if($users->count())
                @foreach($users as $user)
                    <div class="thumbnail">
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($user->usersInfo->avatar))
                                    <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                                        <img style="min-height:30px; min-width:30px;" class="media-object" src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}"/>
                                    </a>
                                @elseif($user->gender == 'Male')
                                    <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                                        <img style="min-height:30px; min-width:30px;" class="media-object" src="{{ asset('/uploads/avatars/default_male.jpg') }}"/>
                                    </a>
                                @else
                                    <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                                        <img style="min-height:30px; min-width:30px;" class="media-object" src="{{ asset('/uploads/avatars/default_female.jpg') }}"/>
                                    </a>
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"></h4>
                                <strong><a href="{{ route('profile',['regno' => $user->reg_no]) }}">{{ $user->full_name }}</a></strong> accepted your friend request.
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="container text-center">
        {{ $users->links() }}
    </div>

@endsection