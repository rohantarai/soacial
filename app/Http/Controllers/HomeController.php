<?php

namespace App\Http\Controllers;

use App\User;
use App\Institute;
use App\UsersInfo;
use App\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public $mutualFriends = [];
    public $presentUserFriends = [];

    public function index(Request $request)
    {
        Validator::make($request->all(), [
            'alpha'       => 'alpha',
            'institute'   => 'string',
            'year'        => 'digits:4',
            'interest'    => 'numeric',
            'query'       => 'regex:/^[A-Za-z. ]+$/|max:30'
        ])->validate();

        // GETS ALL institutes NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $institutes = Institute::orderBy('id')->get();

        // GETS ALL interests NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $interests = Interest::orderBy('id')->get();

        // GETS ALL years NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $years = UsersInfo::join('users', 'usersinfo.user_regno','=','users.reg_no')
            ->select('usersinfo.academicYear_to')
            ->distinct()
            ->where('users.verified',1)
            ->orderBy('usersinfo.academicYear_to','desc')
            ->get();


            $users = User::join('usersinfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                /*->join('friend_user', 'users.id', '=', 'friend_user.user_id')*/
                /*->join('friend_user', function ($join) {
                    $join->on('users.id', '=', 'friend_user.user_id')
                        ->orOn('users.id', '=', 'friend_user.friend_id');
                })*/
                ->with(['pendingRequests','approvedRequests','institutes', 'usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
                }])
                ->select('users.id','users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.gender')
                ->where('users.verified', 1)
                ->where('users.reg_no', '!=', Auth::user()->reg_no)
                ->when($request->input('query'), function ($query) use ($request) {
                    return $query->where('users.first_name','LIKE',"{$request->input('query')}%")
                            ->orWhere('last_name','LIKE',"{$request->input('query')}%")
                            ->orWhere(DB::raw("CONCAT_WS(' ',first_name,last_name)"),'LIKE',"{$request->input('query')}%");
                })
                ->when($request->input('alpha'), function ($query) use ($request) {
                    return $query->where('users.first_name', 'LIKE', "{$request->input('alpha')}%");
                })
                ->when($request->input('institute'), function ($query) use ($request) {
                    return $query->where('users.institute', $request->input('institute'));
                })
                ->when($request->input('year'), function ($query) use ($request) {
                    return $query->where('usersinfo.academicYear_to', $request->input('year'));
                })
                ->when($request->input('interest'), function ($query) use ($request) {
                    $query->join('interest_user', 'users.id', '=', 'interest_user.user_id');
                    return $query->where('interest_user.interest_id', $request->input('interest'));
                })
                ->distinct()
                ->orderBy('users.first_name')
                ->paginate(8);

        //Finding Mutual Friends between the present user and auth user

        //filtering out present user's friends

        /*$allUsersFriends = User::join('friend_user', function ($join) {
            $join->on('users.id', '=', 'friend_user.user_id')
                ->orOn('users.id', '=', 'friend_user.friend_id');
        })
            ->with(['usersInfo'  => function ($query) {
                $query->select('usersinfo.id','usersinfo.user_regno', 'usersinfo.avatar');
            }])
            ->select('users.id','users.reg_no','users.first_name','users.last_name','users.gender')
            ->where(function ($query) use ($users){
                $query->where('friend_user.user_id','=',Auth::user()->id)
                    ->orWhere('friend_user.friend_id','=',$users->id)
                    ->where('friend_user.friend_id','=','users.id');
            })
            ->where(function ($query) use ($users) {
                $query->where('users.id', '!=', Auth::user()->id)
                    ->where('users.id','!=',$users->id);
            })
            ->where('friend_user.approved', 1)
            ->where('users.verified', 1)
            ->get();*/

        /*foreach($users as $user)
        {
            $this->presentUserFriends[] = $user->with(['usersInfo'  => function ($query) {
                $query->select('usersinfo.user_regno','usersinfo.avatar');
            }])
                ->select('users.id','users.reg_no','users.first_name','users.last_name','users.gender')
                ->join('friend_user', function ($join) {
                    $join->on('users.id', '=', 'friend_user.user_id')
                        ->orOn('users.id', '=', 'friend_user.friend_id');
                })
                ->where(function ($query) use ($user){
                    $query->where('friend_user.user_id','=',$user->id)
                        ->orWhere('friend_user.friend_id','=',$user->id);
                })
                ->where('users.id','!=',$user->id)
                ->where('friend_user.approved', 1)
                ->get();
        }


        //filtering out auth user's friends
        $authUserFriends = Auth::user()->with(['usersInfo'  => function ($query) {
                                $query->select('usersinfo.user_regno','usersinfo.avatar');
                            }])
                            ->select('users.id','users.reg_no','users.first_name','users.last_name','users.gender')
                            ->join('friend_user', function ($join) {
                                $join->on('users.id', '=', 'friend_user.user_id')
                                    ->orOn('users.id', '=', 'friend_user.friend_id');
                            })
                            ->where(function ($query){
                                $query->where('friend_user.user_id','=',Auth::user()->id)
                                    ->orWhere('friend_user.friend_id','=',Auth::user()->id);
                            })
                            ->where('users.id','!=',Auth::user()->id)
                            ->where('friend_user.approved', 1)
                            ->get();


        //finding mutual friends
        if($this->presentUserFriends > $authUserFriends)
        {
            foreach($this->presentUserFriends as $presentUserFriend)
            {
                foreach($authUserFriends as $authUserFriend)
                {
                    if($authUserFriend->id == $presentUserFriend->id)
                    {
                        $this->mutualFriends[] = $authUserFriend;
                    }
                }
            }
        }
        else
        {
            foreach($authUserFriends as $authUserFriend)
            {
                foreach($this->presentUserFriends as $presentUserFriends)
                {
                    foreach($presentUserFriends as $presentUserFriend)
                    {
                        if($presentUserFriend->id == $authUserFriend->id)
                        {
                            $this->mutualFriends[] = $presentUserFriend;
                        }
                    }
                }
            }
        }*/
        
        return view('home')->with(['users' => $users,
                                    'years' => $years,
                                    'institutes' => $institutes,
                                    'interests' => $interests]);

        // THIS SECTION WILL EXECUTE IF NO PARAMETERS IS PRESENT OR THE PARAMETERS ARE null
        /*if(!$request->all() || (!$request->input('alpha') && !$request->input('institute') && !$request->input('year') && !$request->input('interest')))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->orderByRaw('RAND()')
                ->paginate(8);
        }*/

        /*// THIS SECTION WILL EXECUTE IF PARAMETER IS ONLY 'alpha'
        if($request->input('alpha'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where('users.first_name','LIKE',"{$request->input('alpha')}%")
                ->inRandomOrder()
                ->paginate(8);
        }

        // THIS SECTION WILL EXECUTE IF PARAMETER IS ONLY 'alpha & institute'
        if($request->input('alpha') && $request->input('institute'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where(function ($query) use ($request){
                    $query->where('users.first_name','LIKE',"{$request->input('alpha')}%");
                    $query->where('users.institute', $request->input('institute'));
                })
                ->inRandomOrder()
                ->paginate(8);
        }

        // THIS SECTION WILL EXECUTE IF PARAMETER IS ONLY 'institute'
        if($request->input('institute'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where('users.institute', $request->input('institute'))
                ->inRandomOrder()
                ->paginate(8);
        }

        // THIS SECTION WILL EXECUTE IF PARAMETER IS ONLY 'year'
        if($request->input('year'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where('usersinfo.academicYear_to', $request->input('year'))
                ->inRandomOrder()
                ->paginate(8);
        }

        // THIS SECTION WILL EXECUTE IF PARAMETER IS ONLY 'interest'
        if($request->input('interest'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->join('interest_user', 'users.id', '=', 'interest_user.user_id')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where('interest_user.interest_id', $request->input('interest'))
                ->inRandomOrder()
                ->paginate(8);
        }

        // THIS SECTION WILL EXECUTE IF PARAMETER IS ONLY 'alpha' WITH OTHER PARAMETERS AS null
        if($request->input('alpha') && !$request->input('interest') && !$request->input('year') && !$request->input('institute'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where('users.first_name','LIKE',"{$request->input('alpha')}%")
                ->inRandomOrder()
                ->paginate(8);
        }


        if($request->input('alpha') && $request->input('interest') && !$request->input('year') && !$request->input('institute'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->join('interest_user', 'users.id', '=', 'interest_user.user_id')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.reg_no','!=',Auth::user()->reg_no)
                ->where(function ($query) use ($request){
                    $query->where('users.first_name','LIKE',"{$request->input('alpha')}%");
                    $query->where('interest_user.interest_id',$request->input('interest'));
                })
                ->inRandomOrder()
                ->paginate(8);

            $users = Interest::find($request->input('interest'))
                ->users()->join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->with(['institutes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno','usersinfo.academicYear_from','usersinfo.academicYear_to','usersinfo.avatar');
                }])
                ->select('users.reg_no','users.first_name','users.last_name','users.institute','users.gender')
                ->where('users.verified',1)
                ->where('users.first_name','LIKE',"{$request->input('alpha')}%")
                ->inRandomOrder()
                ->orderBy('interest_user.user_id')
                ->paginate(8);
        }

        if($request->input('alpha') && $request->input('interest') && $request->input('year') && !$request->input('institute'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->join('interest_user', 'users.id', '=', 'interest_user.user_id')
                ->with(['institutes', 'usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
                }])
                ->select('interest_user.user_id', 'users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.gender')
                ->where('users.verified', 1)
                ->where('users.reg_no', '!=', Auth::user()->reg_no)
                ->where(function ($query) use ($request) {
                    $query->where('users.first_name', 'LIKE', "{$request->input('alpha')}%");
                    $query->where('interest_user.interest_id', $request->input('interest'));
                    $query->where('usersinfo.academicYear_to', $request->input('year'));
                })
                ->inRandomOrder()
                ->paginate(8);
        }

        if($request->input('alpha') && $request->input('interest') && $request->input('year') && $request->input('institute'))
        {
            $users = User::join('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                ->join('interest_user', 'users.id', '=', 'interest_user.user_id')
                ->with(['institutes', 'usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
                }])
                ->select('interest_user.user_id', 'users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.gender')
                ->where('users.verified', 1)
                ->where('users.reg_no', '!=', Auth::user()->reg_no)
                ->where(function ($query) use ($request) {
                    $query->where('users.first_name', 'LIKE', "{$request->input('alpha')}%");
                    $query->where('interest_user.interest_id', $request->input('interest'));
                    $query->where('usersinfo.academicYear_to', $request->input('year'));
                    $query->where('users.institute', $request->input('institute'));
                })
                ->inRandomOrder()
                ->paginate(8);
        }*/
    }
    
    public function searchProfile(Request $request)
    {
        $data = User::select('first_name','last_name')
                    ->distinct()
                    ->where('verified',1)
                    ->where('reg_no', '!=', Auth::user()->reg_no)
                    ->where(function ($query) use ($request){
                        $query->where('first_name','LIKE',"%{$request->input('query')}%")
                            ->orWhere('last_name','LIKE',"%{$request->input('query')}%")
                            ->orWhere(DB::raw("CONCAT_WS(' ',first_name,last_name)"), 'LIKE',"%{$request->input('query')}%");
                    })
                    ->take(20)
                    ->get();

        return response()->json($data);
    }

    public function addFriend(Request $request)
    {
        $this->validate($request,[
            'regno'    => 'regex:/^[0-9]+$/'
        ]);

        $user = User::select('id')->where('reg_no',$request->regno)->first();

        if(!is_null($user) && !Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id))
        {
            Auth::user()->pendingRequests()->attach($user->id);
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

    public function pendingRequest(Request $request)
    {
        $this->validate($request,[
            'regno'    => 'regex:/^[0-9]+$/',
            'accept'    => 'boolean'
        ]);

        $user = User::select('id')->where('reg_no',$request->regno)->first();

        if($request->accept == true)
        {
            if(!is_null($user) && !Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))
            {
                $user->pendingRequests()->updateExistingPivot(Auth::user()->id, ['approved' => true]);

                return response()->json([
                    'status' => 'success'
                ]);
            }
        }
        else
        {
            if(!is_null($user) && !Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))
            {
                $user->pendingRequests()->detach(Auth::user()->id);

                return response()->json([
                    'status' => 'success'
                ]);
            }
        }

        /*return redirect()->back();*/

        return response()->json([
            'status' => 'error'
        ]);

    }

    public function unFriend(Request $request)
    {
        $this->validate($request,[
            'regno'    => 'regex:/^[0-9]+$/'
        ]);

        $user = User::select('id')->where('reg_no',$request->regno)->first();

        if(!is_null($user) && Auth::user()->approvedRequests->contains($user->id))
        {
            Auth::user()->approvedRequests()->detach($user->id);
        }
        else/*if($user->approvedRequests->contains(Auth::user()->id))*/
        {
            $user->approvedRequests()->detach(Auth::user()->id);
        }

        return redirect()->back();
    }

    /*public function getResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query'  => 'regex:/^[A-Za-z. ]+$/|max:30'
        ]);

        if($validator->fails())
            abort(400);

        // creating an Instance of User model with Eager loading its multiple relationships to reduce the number of queries
        $users = User::with('usersInfo','institutes','programmes')
                    ->where('verified',1)
                    ->where(function ($query) use ($request){
                        $query->where('first_name',$request->input('query'))
                            ->orWhere('last_name',$request->input('query'))
                            ->orWhere(DB::raw("CONCAT_WS(' ',first_name,last_name)"),$request->input('query'));
                    })
                    ->leftJoin('usersInfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                    ->orderBy('academicYear_to','desc')
                    ->paginate(4);

            return view('result',compact('users'));
    }*/

    
}
