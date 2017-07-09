<?php

namespace App\Http\Controllers;

use App\Institute;
use App\User;
use App\UsersInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ConfirmationMail;
use App\Mail\ForgotPasswordMail;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Auth;


class WelcomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function accountActivated()
    {
        return view('template.activated');
    }
    
    public function index()
    {
        return redirect('/');
    }

    // Get a validator for an incoming registration request.
    protected function validator(array $data)
    {
        // left side are the input field names of the form and right side are the validation rules
        // field names should be exact as mentioned in form or else validation will not work
        return Validator::make($data, [
            'regdno'            => 'required|digits:10|unique:users,reg_no',
            'firstname'         => 'required|regex:/^[A-Za-z., _-]+$/|min:2|max:25',
            'lastname'          => 'required|regex:/^[A-Za-z., _-]+$/|min:2|max:25',
            'institute'         => 'required',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:6|different:regdno',
            'confirm_password'  => 'required|same:password',
            'day'               => 'required',
            'month'             => 'required',
            'yearFrom'          => 'required|digits:4',
            'yearTo'            => 'required|digits:4',
            'g-recaptcha-response' => 'required|captcha'
        ],
        [
            'yearFrom.required' => 'Academic Year "From" is required',
            'yearFrom.digits'   => 'Academic Year should be in 4-digits only',
            'yearTo.required'   => 'Academic Year "To" is required',
            'yearTo.digits'     => 'Academic Year should be in 4-digits only',
            'g-recaptcha-response.required' => 'Verify that you are not a Robot'
        ]);
    }

    // Create a new user instance after a valid registration.
    protected function create(array $data)
    {
        // left side are column names of the users table in DB and right side are the names of form input field names
        return User::create([
            'reg_no'        => $data['regdno'],
            'first_name'    => title_case(strtolower($data['firstname'])),
            'last_name'     => title_case(strtolower($data['lastname'])),
            'gender'        => $data['gender'],
            'institute'     => $data['institute'],
            'programme'    => $data['programme'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'plainPassword' => $data['password'],
            'token'         => str_random(40),
        ]);
    }

    // Handle a registration request for the application.
    public function register(Request $request)
    {
        // validates all form input requests
        $this->validator($request->all())->validate();

        // creates a record in the database & create an instance object '$user'
        $user = $this->create($request->all());

        UsersInfo::create([
            'user_regno'    => $request->input('regdno'),
            'born_day'      => $request->input('day'),
            'born_month'    => $request->input('month'),
            'born_year'     => $request->input('year'),
            'academicYear_from'   => $request->input('yearFrom'),
            'academicYear_to'     => $request->input('yearTo'),
        ]);
        //makes a directory for the registered user to store their photos
        Storage::disk('myDisk')->makeDirectory($request->input('regdno'));

        // For Linux Only
        //chmod(public_path('uploads/avatars/'.$request->input('regdno').'/'), 0776);

        // send confirmation mail to the newly created user instance object
        Mail::send(new ConfirmationMail($user->email,$user->token));

        return response()->json([
            'status' => 'success'
        ]);
    }

    // handle the token link received from email via routes
    public function activate($token)
    {
        // check if user's token exists or not
        $user_token = User::select('token')->where('token',$token)->first();

        // check if the user's token is null or not
        if(!is_null($user_token)) {

            // if token is not null then check if verified is true or not
            if ($user_token->verified == 1) {

                // if verified is true then redirect and return Already Activated message
                return redirect('/activated')->with('success', 'Already Activated');
            }

            // else find the token and verify it by calling 'hasVerified' method from User model
            User::whereToken($token)->first()->hasVerified();

            return redirect('/activated')->with('success','Account Activated. You can Login now');
        }
        //return error if user_token is null
        return redirect('/activated')->with('error','Invalid link');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'login'    => 'required|regex:/^[0-9a-z.@]+$/',
            'password'  => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'
        ],
        [
            'g-recaptcha-response.required' => 'Verify that you are not a Robot'
        ]);

        $trashedUser = User::with(['usersInfo' => function ($query) {
            $query->onlyTrashed();
        }])->onlyTrashed()
            ->where(function ($query) use ($request){
            $query->where('email',$request->input('login'))
                ->orWhere('reg_no',$request->input('login'));
        })->first();

        if($trashedUser)
        {
            $trashedUser->restore();
            $trashedUser->usersInfo->restore();
        }

        if(is_numeric($request->input('login')))
        {
            $request->request->add(['reg_no' => $request->input('login')]);

            if(Auth::attempt($request->only('reg_no','password')+['verified' => true],$request->has('remember')))
            {
                $user = Auth::user()->usersInfo;
                $user->ipAddress = $request->ip();
                $user->loggedIn = true;
                $user->save();

                return response()->json([
                    'status' => 'success'
                ]);
            }
        }
        else
        {
            $request->request->add(['email' => $request->input('login')]);

            if(Auth::attempt($request->only('email','password')+['verified' => true],$request->has('remember')))
            {
                $user = Auth::user()->usersInfo;
                $user->ipAddress = $request->ip();
                $user->loggedIn = true;
                $user->save();

                return response()->json([
                    'status' => 'success'
                ]);
            }
        }
        
        return response()->json([
            'status' => 'error'
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->usersInfo;
        $user->loggedIn = false;
        $user->save();

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function forgotPassword(Request $request)
    {
       /*$this->validate($request,[
            'pregno' => 'required|digits:10',
            'pemail' => 'required|email',
        ]);

        $user = User::where('reg_no',$request->input('pregno'))
                    ->orWhere('email',$request->input('pemail'))
                    ->first();*/

        $this->validate($request,[
            'forgotPassword' => 'required|regex:/^[0-9a-z.@]+$/'
        ]);

        $user = User::select('email','plainPassword')
                    ->where('reg_no',$request->input('forgotPassword'))
                    ->orWhere('email',$request->input('forgotPassword'))
                    ->first();

        if($user)
        {
            Mail::send(new ForgotPasswordMail($user->email,$user->plainPassword));

            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'error'
        ]);
    }
    
    public function contactUs(Request $request)
    {
        $this->validate($request,[
            'senderName'  => 'required|regex:/^[a-zA-Z .,]+$/',
            'senderEmail' => 'required|email|regex:/^[0-9a-z.@]+$/',
            'subject'     => 'required|regex:/^[0-9a-zA-Z .,_()@!:&-\\/]+$/|max:100',
            'messages'     => 'required|regex:/^[0-9a-zA-Z !@#&*?()-_+:,.\\/]+$/|max:500',
            'g-recaptcha-response' => 'required|captcha'
        ],
        [
            'senderName.required' => 'Full name is required',
            'senderName.regex' => 'Invalid Full name',
            'senderEmail.required' => 'Email id is required',
            'senderEmail.email' => 'Email is not valid',
            'subject.required' => 'Subject is required',
            'subject.regex' => 'Invalid subject',
            'subject.max' => 'Subject should not exceed 100 characters',
            'messages.required' => 'Message is required',
            'messages.regex' => 'Invalid message',
            'messages.max' => 'Message should not exceed 100 characters',
            'g-recaptcha-response.required' => 'Verify that you are not a Robot'
        ]);
        
        $ip = $request->ip();

        Mail::to('champrohan123@gmail.com')->send(new ContactUsMail($request->senderName,$request->senderEmail,$request->subject,$request->messages, $ip));

        return response()->json([
            'status' => 'success'
        ]);
        
    }

    public function getInstitute()
    {
        // get all column names stored in "&fillable" variable in "Institute" model with Eager Loading its relationships
        $institutes = Institute::all();

        // return "welcome" view along with column names stored in "$institutes" variable
        return view('welcome',compact('institutes'));
    }
}
