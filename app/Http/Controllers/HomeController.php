<?php

namespace App\Http\Controllers;

use App\User;
use App\Institute;
use App\Programme;
use App\UsersInfo;
use App\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\FriendRequestMail;
use App\Mail\FriendAcceptMail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        Validator::make($request->all(), [
            'alpha'       => 'alpha',
            'institute'   => 'string',
            'programme'   => 'string',
            'year'        => 'digits:4',
            'interest'    => 'numeric',
            'query'       => 'regex:/^[A-Za-z. ]+$/|max:30'
        ])->validate();

        // GETS ALL institutes NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $institutes = Institute::orderBy('id')->get();

        // GETS ALL programmes NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $programmes = Programme::when($request->input('institute'), function ($query) use ($request) {
                                return $query->where('institute_id', $request->input('institute'))->orderBy('id')->get();
                            });

        // GETS ALL interests NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $interests = Interest::orderBy('id')->get();

        // GETS ALL years NAME AS AN ARRAY TO DISPLAY ON HOME PAGE
        $years = UsersInfo::join('users', 'usersinfo.user_regno','=','users.reg_no')
            ->select('usersinfo.academicYear_to','users.verified')
            ->distinct()
            ->where('users.verified',1)
            ->orderBy('usersinfo.academicYear_to','desc')
            ->get();


            $users = User::join('usersinfo', function ($join) {
                    $join->on('users.reg_no', '=', 'usersinfo.user_regno')
                        ->where(function ($query){
                            $query->where('users.verified', 1)
                                ->where('users.reg_no', '!=', Auth::user()->reg_no);
                        });
                })
                //join('usersinfo', 'users.reg_no', '=', 'usersinfo.user_regno')
                //->join('friend_user', 'users.id', '=', 'friend_user.user_id')
                ->with(['pendingRequests','approvedRequests','institutes','programmes','usersInfo' => function ($query) {
                    $query->select('usersinfo.user_regno', 'usersinfo.academicYear_from', 'usersinfo.academicYear_to', 'usersinfo.avatar');
                }])
                ->select('users.id','users.reg_no', 'users.first_name', 'users.last_name', 'users.institute', 'users.programme', 'users.gender','users.created_at','users.verified','usersinfo.academicYear_from')
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
                ->when($request->input('programme'), function ($query) use ($request) {
                    return $query->where('users.programme', $request->input('programme'));
                })
                ->when($request->input('year'), function ($query) use ($request) {
                    return $query->where('usersinfo.academicYear_to', $request->input('year'));
                })
                ->when($request->input('interest'), function ($query) use ($request) {
                    $query->join('interest_user', 'users.id', '=', 'interest_user.user_id');
                    return $query->where('interest_user.interest_id', $request->input('interest'));
                })
                ->distinct()
                ->orderBy('usersinfo.academicYear_from','desc')
                ->orderBy('users.reg_no','desc')
                ->simplePaginate(20);
        
        return view('home')->with(['users' => $users,
                                    'years' => $years,
                                    'institutes' => $institutes,
                                    'interests' => $interests,
                                    'programmes' => $programmes]);

    }
    
    public function searchProfile(Request $request)
    {
        $data = User::select('first_name','last_name','verified')
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

        $user = User::select('id','email')->where('reg_no',$request->regno)->first();

        if(!is_null($user) && !Auth::user()->pendingRequests->contains($user->id) && !$user->pendingRequests->contains(Auth::user()->id))
        {
            Auth::user()->pendingRequests()->attach($user->id);
            //Mail::to($user->email)->send(new FriendRequestMail(Auth::user()->email,Auth::user()->full_name));
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

        $user = User::select('id','email')->where('reg_no',$request->regno)->first();

        if($request->accept == true)
        {
            if(!is_null($user) && !Auth::user()->pendingRequests->contains($user->id) && $user->pendingRequests->contains(Auth::user()->id))
            {
                $user->pendingRequests()->updateExistingPivot(Auth::user()->id, ['approved' => true]);

                //Mail::to($user->email)->send(new FriendAcceptMail(Auth::user()->email,Auth::user()->full_name));

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
                    ->paginate(20);

            return view('result',compact('users'));
    }*/
}
