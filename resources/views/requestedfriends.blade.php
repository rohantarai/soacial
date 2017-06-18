@extends('template.layout')
@include('template.notifier')
@section('content')
    <div class="container">
        <div class="row" style="display:flex; flex-wrap: wrap;">
            @foreach($users as $user)
                <div class="col-md-3 col-sm-4">
                    <div class="thumbnail">
                        @if(!is_null($user->usersInfo->avatar))
                            <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                                <img src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}"/>
                            </a>
                        @elseif($user->gender == 'Male')
                            <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                                <img src="{{ asset('/uploads/avatars/default_male.jpg') }}"/>
                            </a>
                        @else
                            <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                                <img src="{{ asset('/uploads/avatars/default_female.jpg') }}"/>
                            </a>
                        @endif

                        @if($user->reg_no == 1441012011)
                            <div class="label label-info" style="display:block;">Founder</div>
                        @endif

                        <div class="caption text-center">
                            <strong style="font-size: 20px">{{ $user->full_name }}</strong>
                            <h6>{{ $user->usersInfo->academicYear_from }} - {{ $user->usersInfo->academicYear_to }}</h6>
                            <h6>{{ $user->institutes->name }}</h6>

                            <a href="{{ route('profile',['regno' => $user->reg_no]) }}" class="btn btn-primary btn-xs" role="button" style="border-radius:50px"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>


                            @if(Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id))

                                <a class="btn btn-default btn-xs deleterequestBtn" role="button" style="border-radius:50px;" href="{{ route('deleteRequest',['regno' => $user->reg_no]) }}">
                                    <i class="fa fa-times" aria-hidden="true"></i> Delete Request
                                </a>
                                {{--<div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs dropdown-toggle" role="button" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="border-radius:50px;">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('deleteRequest',['regno' => $user->reg_no]) }}">Delete Request</a></li>
                                    </ul>
                                </div>--}}
                            @endif

                            {{--@if(!Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))

                                <div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        Request Pending <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('pendingRequest',['regno' => $user->reg_no, 'accept' => true]) }}">Accept</a></li>
                                        <li><a href="{{ route('pendingRequest',['regno' => $user->reg_no, 'accept' => false]) }}">Reject</a></li>
                                    </ul>
                                </div>
                            @endif--}}
                            {{--@if(Auth::user()->approvedRequests->contains($user->id) || $user->approvedRequests->contains(Auth::user()->id))

                                <div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Friends <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('unFriend',['regno' => $user->reg_no]) }}">Unfriend</a></li>
                                    </ul>
                                </div>
                            @endif--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container text-center">
        {{ $users->links() }}
    </div>
@endsection
{{--<div role="tabpanel" class="tab-pane fade" id="pending">
    @foreach($users as $user)
        @if(!Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))
            <div class="col-md-3 col-sm-4">
                <div class="thumbnail">
                    @if(!is_null($user->usersInfo->avatar))
                        <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                            <img src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}"/>
                        </a>
                    @elseif($user->gender == 'Male')
                        <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                            <img src="{{ asset('/uploads/avatars/default_male.jpg') }}"/>
                        </a>
                    @else
                        <a href="{{ route('profile',['regno' => $user->reg_no]) }}">
                            <img src="{{ asset('/uploads/avatars/default_female.jpg') }}"/>
                        </a>
                    @endif
                    <div class="caption text-center">
                        <strong style="font-size: 20px">{{ $user->full_name }}</strong>
                        <h6>{{ $user->usersInfo->academicYear_from }} - {{ $user->usersInfo->academicYear_to }}</h6>
                        <h6>{{ $user->institutes->name }}</h6>
                        <a href="{{ route('profile',['regno' => $user->reg_no]) }}" class="btn btn-primary btn-xs" role="button" style="border-radius:50px"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>

                        --}}{{--@if(!Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id) && !$user->approvedRequests->contains(Auth::user()->id) && !Auth::user()->approvedRequests->contains($user->id))

                            <a href="{{ route('addFriend',['regno' => $user->reg_no]) }}" class="btn btn-default btn-xs friendBtn" role="button" style="border-radius:50px"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Friend</a>

                        @endif

                        @if(Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id))

                            <a href="#" class="btn btn-default btn-xs disabled" role="button" style="border-radius:50px; cursor:default;">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent
                            </a>

                            <div class="btn btn-default btn-xs" style="border-radius:50px;cursor: default">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent
                                </div>

                            <div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Request Pending <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Delete Follow Request</a></li>
                                    </ul>
                            </div>
                        @endif--}}{{--

                        @if(!Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))

                            <div class="btn-group">
                                <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    Request Pending <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('pendingRequest',['regno' => $user->reg_no, 'accept' => true]) }}">Accept</a></li>
                                    <li><a href="{{ route('pendingRequest',['regno' => $user->reg_no, 'accept' => false]) }}">Reject</a></li>
                                </ul>
                            </div>
                        @endif
                        --}}{{--@if(Auth::user()->approvedRequests->contains($user->id) || $user->approvedRequests->contains(Auth::user()->id))

                            <div class="btn-group">
                                <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i> Friends <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('unFriend',['regno' => $user->reg_no]) }}">Unfriend</a></li>
                                </ul>
                            </div>
                        @endif--}}{{--
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>--}}