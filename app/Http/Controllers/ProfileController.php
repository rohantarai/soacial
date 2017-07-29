<?php
namespace Intervention\Image;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
use App\User;
use App\UsersInfo;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public $mutualFriends = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(Request $request)
    {
        $this->validate($request,[
            'regno'    => 'regex:/^[0-9]+$/'
        ]);

        $user = User::with('usersInfo','institutes','programmes')
                    ->select('id','reg_no','first_name','last_name','gender','institute','programme','email','verified')
                    ->where('verified',1)
                    ->where('reg_no',$request->regno)
                    ->first();

        //Finding Mutual Friends between the present user and auth user

        //filtering out present user's friends
        $presentUserFriends = $user->with(['usersInfo'  => function ($query) {
                            $query->select('usersinfo.user_regno','usersinfo.avatar');
                        }])
                        ->select('users.id','users.reg_no','users.first_name','users.last_name','users.gender','users.verified')
                        ->join('friend_user', function ($join) {
                            $join->on('users.id', '=', 'friend_user.user_id')
                                ->orOn('users.id', '=', 'friend_user.friend_id');
                        })
                        ->where(function ($query) use ($user){
                            $query->where('friend_user.user_id','=',$user->id)
                                ->orWhere('friend_user.friend_id','=',$user->id);
                        })
                        ->where('users.verified',1)
                        ->where('users.id','!=',$user->id)
                        ->where('friend_user.approved', 1)
                        ->get();

        //filtering out auth user's friends
        $authUserFriends = Auth::user()->with(['usersInfo'  => function ($query) {
                                $query->select('usersinfo.user_regno','usersinfo.avatar');
                            }])
                            ->select('users.id','users.reg_no','users.first_name','users.last_name','users.gender','users.verified')
                            ->join('friend_user', function ($join) {
                                $join->on('users.id', '=', 'friend_user.user_id')
                                    ->orOn('users.id', '=', 'friend_user.friend_id');
                            })
                            ->where(function ($query){
                                $query->where('friend_user.user_id','=',Auth::user()->id)
                                    ->orWhere('friend_user.friend_id','=',Auth::user()->id);
                            })
                            ->where('users.id','!=',Auth::user()->id)
                            ->where('users.verified',1)
                            ->where('friend_user.approved', 1)
                            ->get();
        
        //finding mutual friends
        if($presentUserFriends > $authUserFriends)
        {
            foreach($presentUserFriends as $presentUserFriend)
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
                foreach($presentUserFriends as $presentUserFriend)
                {
                    if($presentUserFriend->id == $authUserFriend->id)
                    {
                        $this->mutualFriends[] = $presentUserFriend;
                    }
                }
            }
        }
        

        if(!$user)
            abort(404);

        //$Path = 'uploads/avatars/'.$user->reg_no.'/';
        //$images = glob($Path."*");


        return view('profile')->with([/*'images' => $images,*/'user' => $user, 'mutualFriends' => $this->mutualFriends]);
        
        /*return view('profile',compact('images','user','mutualFriends'));*/
    }

    public function updateAvatar(Request $request)
    {
        //this validator passes the errors automatically to the "editprofile" page with the variable called "$errors"
        Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,jpg|max:7168',
        ],[
            'image.max'  => 'File size should not exceed 7MB',
        ])->validate();
        
        $user = Auth::user()->usersInfo;

        //removing previous photo if exists
        if(!is_null($user->avatar))
        {
            unlink(public_path('/uploads/avatars/'.$user->user_regno.'/'.$user->avatar));
        }

        $avatar = $request->file('image');
        $destinationPath = public_path('/uploads/avatars/'.$user->user_regno.'/');
        $filename = date("dMY_g.iaT"). '.' .$avatar->getClientOriginalExtension();

        $x = $request->input('x');
        $y = $request->input('y');
        $width = $request->input('width');
        $height = $request->input('height');
        $scale = $request->input('scale');
        $angle = $request->input('angle');

        /*dd($request->all());*/

        $image = Image::make($avatar)->rotate(-$angle);
        $image->widen(intval($image->width()*$scale));
        $image->crop($width, $height, $x, $y);
        $image->save($destinationPath.$filename);
        $image->destroy();

        $user->avatar = $filename;
        $user->save();
        
        return redirect()->back()->with('success','Uploaded Successfully');
    }
    
    public function deactivateIndex(Request $request)
    {
        $this->validate($request,[
            'regno'    => 'regex:/^[0-9]+$/'
        ]);

        return view('template.deactivate');
    }

    public function deactivate(Request $request)
    {
        Validator::make($request->all(), [
            'deactivate'  => 'digits:1',
        ])->validate();

        if($request->input('deactivate') == 1)
        {
            $user = Auth::user();
            $user->usersInfo->loggedIn = false;
            $user->usersInfo->save();
            $user->usersInfo->delete();
            $user->delete();
            /*$user->usersInfo->delete();*/

            $request->session()->flush();
            $request->session()->regenerate();
        }
        else
            abort(404);

        return redirect('/');
    }

}
