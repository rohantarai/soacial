<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo2.png') }}" alt="Brand" style="margin-top: -15px; max-width: 50px;">
            </a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            @if(Auth::check())
            <ul class="nav navbar-nav">
                <li role="button"> <a href="{{ url('/') }}">Home</a></li>
                {{--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Friends <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/allfriends') }}">All Friends <span class="badge">{{ $countFriends }}</span></a></li>
                        <li><a href="{{ url('/pendingfriends') }}">Requests Pending <span class="badge">{{ $countPendingFriends }}</span></a></li>
                        <li><a href="{{ url('/requestedfriends') }}">Requests Sent <span class="badge">{{ $countRequestedFriends }}</span></a></li>
                    </ul>
                </li>--}}
            </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profile',['regno' => Auth::user()->reg_no]) }}">My Profile</a></li>
                        <li><a href="{{ route('editProfile') }}">Edit Profile</a></li>
                        <li><a href="{{ route('changePassword') }}">Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout_user') }}">Logout</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('deactivateAccount',['regno' => Auth::user()->reg_no]) }}">Deactivate Account</a></li>
                    </ul>
                </li>
                @else
                    <li role="button" ><a data-toggle="modal" data-target="#myModallogin">Login</a></li>
                    <li role="button" ><a data-toggle="modal" data-target="#myModalregister">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>