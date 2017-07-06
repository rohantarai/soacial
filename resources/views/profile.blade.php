@extends('template.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="thumbnail">
                    @if(!is_null($user->usersInfo->avatar))
                        @if($user->approvedRequests->contains(Auth::user()->id) || Auth::user()->approvedRequests->contains($user->id) || Auth::user()->reg_no == $user->reg_no)
                        <a href="#"><img class="dp" src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}"/></a>
                        @elser
                            <img src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}"/>
                        @endif
                    @elseif($user->gender == 'Male')
                        <img src="{{ asset('/uploads/avatars/default_male.jpg') }}"/>
                    @else
                        <img src="{{ asset('/uploads/avatars/default_female.jpg') }}"/>
                    @endif
                    <div class="caption text-center">
                        <strong style="font-size: 25px;">{{ $user->full_name }}</strong>
                    </div>

                    @if($user->reg_no == 1441012011)
                        <div class="label label-info" style="display:block;">Founder</div>
                    @endif

                </div>
                @if(!Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id) && !$user->approvedRequests->contains(Auth::user()->id) && !Auth::user()->approvedRequests->contains($user->id))
                    @if(Auth::user()->reg_no != $user->reg_no)
                    <a href="{{ route('addFriend',['regno' => $user->reg_no]) }}" class="btn btn-default btn-xs friendBtn" role="button" style="border-radius:50px">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Add Friend
                    </a>
                    @endif
                @endif
                @if(Auth::user()->pendingRequests->contains($user->id))
                    <a href="#" class="btn btn-default btn-xs disabled" role="button" style="border-radius:50px; cursor:default;">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent
                    </a>
                @endif
                @if($user->pendingRequests->contains(Auth::user()->id))
                    <div class="btn-group">
                        <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            Request Pending <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pendingRequestBtn">
                            <li><a href="{{ route('pendingRequest',['regno' => $user->reg_no, 'accept' => true]) }}">Accept</a></li>
                            <li><a href="{{ route('pendingRequest',['regno' => $user->reg_no, 'accept' => false]) }}">Reject</a></li>
                        </ul>
                    </div>
                @endif
                @if(Auth::user()->approvedRequests->contains($user->id) || $user->approvedRequests->contains(Auth::user()->id))
                    <div class="btn-group">
                        <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-check-circle" aria-hidden="true"></i> Friends <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('unFriend',['regno' => $user->reg_no]) }}">Unfriend</a></li>
                        </ul>
                    </div>
                @endif
            @if(Auth::user()->reg_no == $user->reg_no)
                <button type="button" class="btn btn-primary btn-xs" id="updatePhotoBtn" data-toggle="modal" data-target="#myModalAvatar" style="border-radius:50px">Update Photo</button>
            @else
                    @if(count($mutualFriends) != 0)
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalMutuals" style="border-radius:50px;">
                            <span class="badge">{{ count($mutualFriends) }}</span> Mutual
                        </button>
                    @endif
            @endif
                <div>
                    <br>
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <strong> Success! </strong>{{ session()->get('success') }}
                        </div>
                    @elseif($errors->has('image'))
                        <div class="alert alert-danger" role="alert">
                            <strong> Error! </strong>{{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
            </div>
            <div id="bg" class="col-md-9">
                <div class="container-fluid">
                    <ul class="nav nav-tabs">
                        <li class="active"> <a href="#about" data-toggle="tab"><strong>About</strong></a></li>
                        <li> <a href="#photos" data-toggle="tab"><strong>Photos</strong></a></li>
                        <li> <a href="#contact" data-toggle="tab"><strong>Social</strong></a></li>
                    </ul>
                    @if(Auth::user()->approvedRequests->contains($user->id) || $user->approvedRequests->contains(Auth::user()->id) || Auth::user()->reg_no == $user->reg_no)
                    <div class="tab-content">
                        <div id="about" class="tab-pane fade in active">
                            <div class="container-fluid">
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Academic Year:</dt>
                                    <dd>{{ $user->usersInfo->academicYear_from }} - {{ $user->usersInfo->academicYear_to }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Institute:</dt>
                                    <dd>{{ $user->institutes->name }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Programme:</dt>
                                    <dd>{{ $user->programmes->name }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>High School:</dt>
                                    <dd>{{ $user->usersInfo->high_school }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Current City:</dt>
                                    <dd>{{ $user->usersInfo->current_city }}</dd>
                                    <br>
                                    <dt>Hometown:</dt>
                                    <dd>{{ $user->usersInfo->hometown }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Date of Birth:</dt>
                                    <dd>{{ $user->usersInfo->born_day }} {{ $user->usersInfo->born_month }} {{ $user->usersInfo->born_year }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Gender:</dt>
                                    <dd>{{ $user->gender }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Relationship Status:</dt>
                                    <dd>{{ $user->usersInfo->relationship }}</dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Favourite Quotes:</dt>
                                    <dd><?php echo clean($user->usersInfo->quotes) ?></dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Interests:</dt>
                                        <dd>
                                            @foreach($user->interests as $interest)
                                                <span class="label label-default">{{ $interest->name }}</span>
                                            @endforeach
                                        </dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>Achievements:</dt>
                                    <dd><?php echo clean($user->usersInfo->achievements) ?></dd>
                                </dl>
                                <hr>
                                <dl class="dl-horizontal">
                                    <dt>About Me:</dt>
                                    <dd><?php echo clean($user->usersInfo->about) ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div id="photos" class="tab-pane fade">
                            <div class="row">
                                {{--<a class="btn btn-info btn-xs" role="button" href="#" id="position">Upload </a>--}}
                                @if(Auth::user()->reg_no == $user->reg_no)
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#deletePhoto" style="margin-top:10px; border-radius:50px">Delete Photo</button>
                                @endif
                            </div>
                            <div class="row" style="display:flex; flex-wrap: wrap; margin-top:10px;">
                                <div class="album">
                                @foreach($images as $image)
                                        <a href="#"><img src="{{ asset("$image") }}" class="col-md-2 col-xs-4 thumbnail" /></a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="contact" class="tab-pane fade">
                            <div class="container-fluid" style="margin-top:10px;">
                                @if($user->usersInfo->facebook)
                                    <a id="fb" href="{{ url('https://fb.com/'.$user->usersInfo->facebook) }}" target="_blank"><i class="fa fa-facebook-square fa-4x" aria-hidden="true"></i></a>
                                    <a href="{{ url('https://m.me/'.$user->usersInfo->facebook) }}" target="_blank"><img src="{{ asset('/img/fbme.png') }}" style="position:relative;top:-15px" /></a>
                                @endif
                                @if($user->usersInfo->instagram)
                                    <a id="is" href="{{ url('https://instagram.com/'.$user->usersInfo->instagram) }}" target="_blank"><i class="fa fa-instagram fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->googleplus)
                                    <a id="gp" href="{{ url('https://plus.google.com/'.$user->usersInfo->googleplus) }}" target="_blank"><i class="fa fa-google-plus-square fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->linkedin)
                                    <a id="li" href="{{ url('https://in.linkedin.com/in/'.$user->usersInfo->linkedin) }}" target="_blank"><i class="fa fa-linkedin-square fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->twitter)
                                    <a id="tw" href="{{ url('https://twitter.com/'.$user->usersInfo->twitter) }}" target="_blank"><i class="fa fa-twitter-square fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->youtube)
                                    <a id="yt" href="{{ url('https://youtube.com/'.$user->usersInfo->youtube) }}" target="_blank"><i class="fa fa-youtube-square fa-4x" aria-hidden="true"></i></a>
                                @endif
                                {{--@if($user->usersInfo->quora)
                                    <a id="qu" href="{{ url('https://quora.com/profile/'.$user->usersInfo->quora) }}" target="_blank"><i class="fa fa-quora fa-4x" aria-hidden="true"></i></a>
                                @endif--}}
                                @if($user->usersInfo->skype)
                                    <a id="sk" data-toggle="tooltip" data-placement="bottom" title="{{ $user->usersInfo->skype }}"><i class="fa fa-skype fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->snapchat)
                                    <a id="sc" data-toggle="tooltip" data-placement="bottom" title="{{ $user->usersInfo->snapchat }}"><i class="fa fa-snapchat-square fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->telegram)
                                    <a id="te" data-toggle="tooltip" data-placement="bottom" title="{{ $user->usersInfo->telegram }}"><i class="fa fa-telegram fa-4x" aria-hidden="true"></i></a>
                                @endif
                                @if($user->usersInfo->whatsapp)
                                    <a id="wq" data-toggle="tooltip" data-placement="bottom" title="{{ $user->usersInfo->whatsapp }}"><i class="fa fa-whatsapp fa-4x" aria-hidden="true"></i></a>
                                @endif
                                    <a data-toggle="tooltip" data-placement="bottom" title="{{ $user->email }}" style="color:#d34836;"><i class="fa fa-envelope-o fa-4x" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="text-center">
                            <h3 style="color: lightgrey;">Only {{$user->first_name}}'s friends can see this profile</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="myModalAvatar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="avatarUploadForm" role="form" method="post" enctype="multipart/form-data" action="{{ route('ProfileAvatar') }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Photo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="thumbnail">
                                    <img src="{{ asset('/img/loading.gif') }}" id="avatarLoading" style="display:none">
                                    {{--<img src="{{ asset('/uploads/avatars/'.Auth::user()->usersInfo->avatar) }}" id='avatar'>--}}
                                    @if(!is_null($user->usersInfo->avatar))
                                        <img src="{{ asset('/uploads/avatars/'.$user->usersInfo->user_regno.'/'.$user->usersInfo->avatar) }}" id="avatar">
                                    @elseif($user->gender == 'Male')
                                        <img src="{{ asset('/uploads/avatars/default_male.jpg') }}" id="avatar">
                                    @else
                                        <img src="{{ asset('/uploads/avatars/default_female.jpg') }}" id="avatar">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <label>Select Your Image</label><br/>
                            <input type="file" name="image" id="image" accept="image/*" required>
                            <br>
                            <div id="progress" class="">
                                <div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>

                        <input type="hidden"  name="x" id="x">
                        <input type="hidden"  name="y" id="y">
                        <input type="hidden"  name="width" id="w">
                        <input type="hidden"  name="height" id="h">
                        <input type="hidden"  name="scale" id="scale">
                        <input type="hidden"  name="angle" id="angle">

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href='#' id='rotate_left'  title='Rotate left'><i class='fa fa-rotate-left fa-3x'></i></a>
                                <a href='#' id='zoom_out'     title='Zoom out'><i class='fa fa-search-minus fa-3x'></i></a>
                                <a href='#' id='fit'          title='Fit image'><i class='fa fa-arrows-alt fa-3x'></i></a>
                                <a href='#' id='zoom_in'      title='Zoom in'><i class='fa fa-search-plus fa-3x'></i></a>
                                <a href='#' id='rotate_right' title='Rotate right'><i class='fa fa-rotate-right fa-3x'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius:50px">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit" style="border-radius:50px">Save changes</button>
                    </div>
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="deletePhoto">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Click on the Image to delete it.</p>
                    <div class="row" style="display:flex; flex-wrap: wrap;">
                        @foreach($images as $image)
                        <a href="{{ asset("$image") }}" target="_blank" class="col-md-2 col-xs-4 thumbnail delete" >
                            <img src="{{ asset("$image") }}" class="img-responsive" id="delete" />
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Mutual Friends -->
    <div class="modal fade" id="myModalMutuals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mutual Friends</h4>
                </div>
                <div class="modal-body">
                    @if(count($mutualFriends) > 1)
                        <div class="row" style="display:flex; flex-wrap: wrap;">
                            @foreach($mutualFriends as $mutualFriend)
                                <div class="col-md-3 col-xs-6">
                                    <a href="{{ route('profile',['regno' => $mutualFriend->reg_no]) }}">

                                        @if(!is_null($mutualFriend->usersInfo->avatar))

                                            <img style="height:100px; width: 100px;" src="{{ asset('/uploads/avatars/'.$mutualFriend->usersInfo->user_regno.'/'.$mutualFriend->usersInfo->avatar) }}">

                                        @elseif($mutualFriend->gender == 'Male')

                                            <img style="height:100px; width: 100px;" src="{{ asset('/uploads/avatars/default_male.jpg') }}">

                                        @else

                                            <img style="height:100px; width: 100px;" src="{{ asset('/uploads/avatars/default_female.jpg') }}">

                                        @endif
                                    </a>
                                    <p>{{ $mutualFriend->full_name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            @foreach($mutualFriends as $mutualFriend)
                                <div class="col-md-3 col-xs-6">
                                    <a href="{{ route('profile',['regno' => $mutualFriend->reg_no]) }}">

                                        @if(!is_null($mutualFriend->usersInfo->avatar))

                                            <img style="height:100px; width: 100px;" src="{{ asset('/uploads/avatars/'.$mutualFriend->usersInfo->user_regno.'/'.$mutualFriend->usersInfo->avatar) }}">

                                        @elseif($mutualFriend->gender == 'Male')

                                            <img style="height:100px; width: 100px;" src="{{ asset('/uploads/avatars/default_male.jpg') }}">

                                        @else

                                            <img style="height:100px; width: 100px;" src="{{ asset('/uploads/avatars/default_female.jpg') }}">

                                        @endif
                                    </a>
                                    <p>{{ $mutualFriend->full_name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius:50px;">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.album').viewer({
                title: false,
                movable: false,
                maxZoomRatio: 10
            });

            $('.dp').viewer({
                title: false,
                movable: false,
                maxZoomRatio: 10
            });
        });
    </script>
@endsection