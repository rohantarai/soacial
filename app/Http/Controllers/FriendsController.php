<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendsController extends Controller
{
    public function allFriends()
    {
        $users = User::join('friend_user', function ($join) {
                $join->on('users.id', '=', 'friend_user.user_id')
                    ->orOn('users.id', '=', 'friend_user.friend_id');
            })
            ->with(['approvedRequests','institutes', 'usersInfo' => function ($query) {
                $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
            }])
            ->select('users.id','users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.gender')
            ->where('users.verified', 1)
            ->where('users.reg_no', '!=', Auth::user()->reg_no)
            ->where(function ($query) {
                $query->where('user_id',Auth::user()->id)
                    ->orWhere('friend_id',Auth::user()->id);
            })
            ->where('approved', 1)
            ->distinct()
            ->orderBy('friend_user.updated_at','desc')
            ->paginate(20);

        return view('allfriends',compact('users'));
    }

    public function pendingFriends()
    {
        $users = User::join('friend_user', function ($join) {
                $join->on('users.id', '=', 'friend_user.user_id')
                    ->orOn('users.id', '=', 'friend_user.friend_id');
            })
            ->with(['approvedRequests','institutes', 'usersInfo' => function ($query) {
                $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
            }])
            ->select('users.id','users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.gender')
            ->where('users.verified', 1)
            ->where('users.reg_no', '!=', Auth::user()->reg_no)
            ->where('friend_id',Auth::user()->id)
            ->where('approved', 0)
            ->distinct()
            ->orderBy('friend_user.created_at','desc')
            ->paginate(20);
        
        return view('pendingfriends',compact('users'));
    }

    public function requestedFriends()
    {
        $users = User::join('friend_user', function ($join) {
                $join->on('users.id', '=', 'friend_user.user_id')
                    ->orOn('users.id', '=', 'friend_user.friend_id');
            })
            ->with(['approvedRequests','institutes', 'usersInfo' => function ($query) {
                $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
            }])
            ->select('users.id','users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.gender')
            ->where('users.verified', 1)
            ->where('users.reg_no', '!=', Auth::user()->reg_no)
            ->where('user_id',Auth::user()->id)
            ->where('approved', 0)
            ->distinct()
            ->orderBy('friend_user.created_at','desc')
            ->paginate(20);

        return view('requestedfriends',compact('users'));
    }

    public function deleteRequest(Request $request)
    {
        $this->validate($request,[
            'regno'    => 'regex:/^[0-9]+$/'
        ]);

        $user = User::select('id')->where('reg_no',$request->regno)->first();

        if(!is_null($user) && Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id))
        {
            Auth::user()->pendingRequests()->detach($user->id);
        }
        else
        {
            return response()->json([
                'status' => 'error'
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
