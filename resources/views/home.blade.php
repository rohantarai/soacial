@extends('template.layout')
@include('template.notifier')
@section('content')

    {{--<div class="thumbnail" style="background-color: transparent; border-color: transparent">
        <img src="{{ asset('img/soacial.png') }}">
    </div>--}}
    {{--@include('template.search')--}}

    <div class="container text-center">
        <form id="filter" method="get" role="form" action="{{ route('home') }}">
            <input type="hidden" name="alpha" value="{{ request()->input('alpha') }}">
            <input type="hidden" name="institute" value="{{ request()->input('institute') }}">
            <input type="hidden" name="year" value="{{ request()->input('year') }}">
            <input type="hidden" name="interest" value="{{ request()->input('interest') }}">
            <input type="hidden" name="programme" value="{{ request()->input('programme') }}">
            {{--<input type="hidden" name="gender" value="{{ request()->input('gender') }}">--}}
            {{--<input type="hidden" name="relationship" value="{{ request()->input('relationship') }}">--}}
            {{--<nav aria-label="Page navigation">
                <ul class="pagination">
                    <li value="A"><a href="#">A</a></li>
                    <li value="B"><a href="#">B</a></li>
                    <li value="C"><a href="#">C</a></li>
                    <li value="D"><a href="#">D</a></li>
                    <li value="E"><a href="#">E</a></li>
                    <li value="F"><a href="#">F</a></li>
                    <li value="G"><a href="#">G</a></li>
                    <li value="H"><a href="#">H</a></li>
                    <li value="I"><a href="#">I</a></li>
                    <li value="J"><a href="#">J</a></li>
                    <li value="K"><a href="#">K</a></li>
                    <li value="L"><a href="#">L</a></li>
                    <li value="M"><a href="#">M</a></li>
                    <li value="N"><a href="#">N</a></li>
                    <li value="O"><a href="#">O</a></li>
                    <li value="P"><a href="#">P</a></li>
                    <li value="Q"><a href="#">Q</a></li>
                    <li value="R"><a href="#">R</a></li>
                    <li value="S"><a href="#">S</a></li>
                    <li value="T"><a href="#">T</a></li>
                    <li value="U"><a href="#">U</a></li>
                    <li value="V"><a href="#">V</a></li>
                    <li value="W"><a href="#">W</a></li>
                    <li value="X"><a href="#">X</a></li>
                    <li value="Y"><a href="#">Y</a></li>
                    <li value="Z"><a href="#">Z</a></li>
                </ul>
            </nav>--}}
            <div class="row" style="display:flex;">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
                    <input type="text" class="form-control" name="query" id="query" value="{{ request()->input('query') }}" placeholder="Search Anyone :)" autocomplete="off" style="border-radius:50px" required>
                </div>
                <button type="submit" class="fa fa-search fa-2x" aria-hidden="true" style="position:relative; margin-left: -70px; background-color: transparent; border-color: transparent"></button>
            </div>

            <div class="panel panel-default" style="border-radius: 50px;">
                <div class="panel-heading" role="tab" id="headingOne" style="border-radius: 50px;">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="panel-title">
                            Filter
                        </h4>
                    </a>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <ul class="nav nav-tabs nav-justified">
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Alphabet <span class="caret"></span> <span class="label label-default">{{ request()->input('alpha') }}</span>
                                </a>
                                <ul class="dropdown-menu alphabet" style="height:auto; max-height:150px; overflow-x:hidden;">
                                    <li value=""><a href="#">---Reset---</a></li>
                                    <li value="A"><a href="#">A</a></li>
                                    <li value="B"><a href="#">B</a></li>
                                    <li value="C"><a href="#">C</a></li>
                                    <li value="D"><a href="#">D</a></li>
                                    <li value="E"><a href="#">E</a></li>
                                    <li value="F"><a href="#">F</a></li>
                                    <li value="G"><a href="#">G</a></li>
                                    <li value="H"><a href="#">H</a></li>
                                    <li value="I"><a href="#">I</a></li>
                                    <li value="J"><a href="#">J</a></li>
                                    <li value="K"><a href="#">K</a></li>
                                    <li value="L"><a href="#">L</a></li>
                                    <li value="M"><a href="#">M</a></li>
                                    <li value="N"><a href="#">N</a></li>
                                    <li value="O"><a href="#">O</a></li>
                                    <li value="P"><a href="#">P</a></li>
                                    <li value="Q"><a href="#">Q</a></li>
                                    <li value="R"><a href="#">R</a></li>
                                    <li value="S"><a href="#">S</a></li>
                                    <li value="T"><a href="#">T</a></li>
                                    <li value="U"><a href="#">U</a></li>
                                    <li value="V"><a href="#">V</a></li>
                                    <li value="W"><a href="#">W</a></li>
                                    <li value="X"><a href="#">X</a></li>
                                    <li value="Y"><a href="#">Y</a></li>
                                    <li value="Z"><a href="#">Z</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Institute <span class="caret"></span> <span class="label label-default">{{ request()->input('institute') }}</span>
                                </a>
                                <ul class="dropdown-menu institute" style="height:auto; max-height:150px; overflow-x:hidden;">
                                    <li value=""><a href="#">---Reset---</a></li>
                                    @foreach($institutes as $institute)
                                        <li value="{{ $institute->id }}"><a href="#">{{ $institute->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Programme <span class="caret"></span> <span class="label label-default">{{ request()->input('programme') }}</span>
                                </a>
                                <ul class="dropdown-menu programme" style="height:auto; max-height:150px; overflow-x:hidden;">
                                    <li value=""><a href="#">---Reset---</a></li>
                                    @foreach($programmes as $programme)
                                        <li value="{{ $programme->id }}"><a href="#">{{ $programme->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Passout Year <span class="caret"></span> <span class="label label-default">{{ request()->input('year') }}</span>
                                </a>
                                <ul class="dropdown-menu year" style="height:auto; max-height:150px; overflow-x:hidden;">
                                    <li value=""><a href="#">---Reset---</a></li>
                                    @foreach($years as $year)
                                        <li value="{{ $year->academicYear_to }}"><a href="#">{{ $year->academicYear_to }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Interest <span class="caret"></span> <span class="label label-default">{{ request()->input('interest') }}</span>
                                </a>
                                <ul class="dropdown-menu interest" style="height:auto; max-height:150px; overflow-x:hidden;">
                                    <li value=""><a href="#">---Reset---</a></li>
                                    @foreach($interests as $interest)
                                        <li value="{{ $interest->id }}"><a href="#">{{ $interest->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            {{--<li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Gender <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu gender" style="height:auto; max-height:150px; overflow-x:hidden;">
                                    <li role="presentation" id="male" value="male"><a href="#">Male</a></li>
                                    <li role="presentation" id="female" value="female"><a href="#">Female</a></li>
                                </ul>
                            </li>--}}

                            {{--<li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Relationship Status <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li value="Single"><a href="#">Single</a></li>
                                    <li value="Forever Single"><a href="#">Forever Single</a></li>
                                    <li value="In Relationship"><a href="#">In Relationship</a></li>
                                    <li value="In Long-Distance Relationship"><a href="#">In Long-Distance Relationship</a></li>
                                    <li value="Its Complicated"><a href="#">Its Complicated</a></li>
                                </ul>
                            </li>--}}
                            <li>
                                <a href="{{ url('/') }}">
                                    <small>Reset all</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {

            var form = $('#filter');

            $('.alphabet li').click(function () {
                var alpha = $(this).attr("value");
                form.find('input[name="alpha"]').val(alpha);
                form.submit();
            });
            $('.institute li').click(function () {
                var institute = $(this).attr("value");
                form.find('input[name="institute"]').val(institute);
                form.submit();
            });
            if(!$('input[name="institute"]').val()) {
                $('.programme li').append('<li>You have not selected any Institute</li>').css('margin-left','15px');
            }
            else{
                $('.programme li').click(function () {
                    var programme = $(this).attr("value");
                    form.find('input[name="programme"]').val(programme);
                    form.submit();
                });
            }
            $('.year li').click(function () {
                var year = $(this).attr("value");
                form.find('input[name="year"]').val(year);
                form.submit();
            });
            $('.interest li').click(function () {
                var interest = $(this).attr("value");
                form.find('input[name="interest"]').val(interest);
                form.submit();
            });

            var path = "{{ route('searchProfile') }}";
            $('#query').typeahead({
                ajax: path,
                items: 20,
                valueField: 'id',
                displayField: 'full_name',
                scrollBar: true,
                autoSelect: false,
                alignWidth: true,
                onSelect: function () {
                    $('#query').change(function() {
                        form.submit();
                    });
                }
            });

            form.submit(function() {
                $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
                return true; // ensure form still submits
            });
            /*$('.gender li').click(function () {
                var gender = $(this).attr("value");
                form.find('input[name="gender"]').val(gender);
                form.submit();
            });*/

        });
    </script>

    <div class="container">
        @if(!$users->count())
            <div class="alert alert-danger" role="alert">
                <p>No Results</p>
            </div>
        @else
            <div class="row" style="display:flex; flex-wrap: wrap;">
            {{--@foreach($users->chunk(8) as $chunked_user)--}}
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

                                {{--@if(count($mutualFriends) != 0)
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalMutuals" style="border-radius:50px;">
                                    <span class="badge">{{ count($mutualFriends) }}</span> Mutuals
                                </button>
                                @endif--}}

                                <a href="{{ route('profile',['regno' => $user->reg_no]) }}" class="btn btn-primary btn-xs" role="button" style="border-radius:50px"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>

                                @if(!Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id) && !$user->approvedRequests->contains(Auth::user()->id) && !Auth::user()->approvedRequests->contains($user->id))

                                    <a href="{{ route('addFriend',['regno' => $user->reg_no]) }}" class="btn btn-default btn-xs friendBtn" role="button" style="border-radius:50px"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Friend</a>

                                @endif

                                @if(Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id))

                                    <a href="#" class="btn btn-default btn-xs disabled" role="button" style="border-radius:50px; cursor:default;">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent
                                    </a>

                                    {{--<div class="btn btn-default btn-xs" style="border-radius:50px;cursor: default">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Request Sent
                                        </div>

                                    <div class="btn-group">
                                            <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Request Pending <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Delete Follow Request</a></li>
                                            </ul>
                                    </div>--}}
                                @endif

                                @if(!Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))

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

                                    {{--<a href="{{ route('profile',['regno' => $user->reg_no]) }}" class="btn btn-primary btn-xs" role="button" style="border-radius:50px"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>--}}

                                    <div class="btn-group">
                                        <a href="#" class="btn btn-default btn-xs dropdown-toggle" style="border-radius:50px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Friends <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('unFriend',['regno' => $user->reg_no]) }}">Unfriend</a></li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            {{--@endforeach--}}
            </div>
        @endif
    </div>
    <div class="container text-center">
        {{ $users->appends(request()->input())->links() }}
    </div>

    <!-- Modal Mutual Friends -->
    {{--<div class="modal fade" id="myModalMutuals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    </div>--}}
{{--<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <a href="{{ url('/iter') }}">
            <div class="thumbnail">
                <img src="{{ asset('/img/iter.jpg') }}" alt="image">
                <div class="caption">
                    <h5 class="text-center">Institute of Technical Education and Research</h5>
                    <h6 class="text-center">(<strong>ITER</strong>) </h6>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/sum.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">Institute of Medical Science &amp; SUM Hospital </h5>
                    <h6 class="text-center">(<strong>IMS &amp; SUM</strong>) </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/sps.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">School of Pharmaceutical Sciences </h5>
                    <h6 class="text-center">(<strong>SPS</strong>) </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/snc.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">SUM Nursing College</h5>
                    <h6 class="text-center">(<strong>SNC</strong>) </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/ids.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">Institute of Dental Sciences </h5>
                    <h6 class="text-center">(<strong>IDS</strong>) </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/ibcs.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">Institute of Business &amp; Computer Studies </h5>
                    <h6 class="text-center">(<strong>IBCS</strong>) </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/shm.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">School of Hotel Management </h5>
                    <h6 class="text-center">(<strong>SHM</strong>) </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/snil.jpg') }}" alt="image">
                <div id="" class="caption">
                    <h5 class="text-center">SOA National Institute of Law </h5>
                    <h6 class="text-center">(<strong>SNIL</strong>) </h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="thumbnail">
                <img src="{{ asset('/img/ias.jpg') }}" alt="Coming Soon">
                <div id="" class="caption">
                    <h5 class="text-center">Institute of Agricultural Sciences </h5>
                    <h6 class="text-center">(<strong>IAS</strong>) </h6>
                </div>
            </div>
        </div>
    </div>
</div>--}}

{{--<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="customSearch">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="customSearchForm" role="form" action="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Custom Search</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <select class="form-control" name="search_institute" id="search_institute" multiple="multiple" title="Institute">
                            @foreach($institutes as $institute)
                                <option value="{{ $institute->name }}">{{ $institute->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="search_programme" id="search_programme" multiple="multiple" title="Programme">
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->name }}">{{ $programme->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="search_PassOutYear" id="search_PassOutYear" multiple="multiple" title="PassOut Year">
                            @foreach($years as $year)
                                <option value="{{ $year->academicYear_to }}">{{ $year->academicYear_to }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="search_gender" id="search_gender" multiple="multiple" title="Gender">
                            <option>Female</option>
                            <option>Male</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="search_relationship" id="search_relationship" multiple="multiple" title="Relationship">
                            <option>Single</option>
                            <option>Forever Single</option>
                            <option>In Relationship</option>
                            <option>In Long-Distance Relationship</option>
                            <option>Its Complicated</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    --}}{{--<img src="{{ asset('/img/ajax-loader.gif') }}" id="search-loading-indicator" style="display:none">--}}{{--
                    <button type="submit" class="btn btn-primary" id="customBtnSearch">Search</button>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            </form>
        </div>
    </div>
</div>--}}
@endsection