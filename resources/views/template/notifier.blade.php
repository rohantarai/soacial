
    @if(Auth::check())
    <i class="fa fa-bell fa-3x" aria-hidden="true" role="button" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-top:400px; position:fixed; z-index:1000; ">
        <span class="badge" style="margin-left: -35px; margin-bottom: 70px;">@if($countPendingFriends){{ $countPendingFriends }}@endif</span>
    </i>
    @endif

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <ul class="nav nav-pills nav-stacked text-center">
                    <li><a href="{{ url('/allfriends') }}">All Friends <span class="badge">@if($countFriends){{ $countFriends }}@endif</span></a></li>
                    <li><a href="{{ url('/pendingfriends') }}">Requests Pending <span class="badge">@if($countPendingFriends){{ $countPendingFriends }}@endif</span></a></li>
                    <li><a href="{{ url('/requestedfriends') }}">Requests Sent <span class="badge">@if($countRequestedFriends){{ $countRequestedFriends }}@endif</span></a></li>
                </ul>
            </div>
        </div>
    </div>