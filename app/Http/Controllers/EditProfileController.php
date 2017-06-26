<?php

namespace Intervention\Image;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UsersInfo;
use Mews\Purifier\Facades\Purifier;
use App\Interest;

class EditProfileController extends Controller
{
    public function index()
    {
        $interests = Interest::all();
        $users = Auth::user();
        if(!$users)
            abort(404);
        
        return view('editprofile',compact('users','interests'));
    }

    public function updateProfile(Request $request)
    {
        Validator::make($request->all(), [
            /*'inputFirstName'    => 'required|regex:/^[A-Za-z., _-]+$/|min:2|max:25',
            'inputLastName'     => 'required|regex:/^[A-Za-z., _-]+$/|min:2|max:25',
            'inputYear1'        => 'required|digits:4',
            'inputYear2'        => 'required|digits:4',*/
            'inputHighSchool'   => 'regex:/^[A-Za-z. -]+$/|max:100',
            'inputCurrentCity'  => 'regex:/^[A-Za-z., -]+$/|max:50',
            'inputHometown'     => 'regex:/^[A-Za-z., -]+$/|max:50',
            'inputYear'         => 'digits:4',
            'inputQuotes'       => 'string|max:2000',
            /*'inputInterests'    => 'required',*/
            'inputAchievements' => 'string|max:2000',
            'inputAboutMe'      => 'string|max:5000',
            'Facebook'          => 'regex:/^[A-Za-z0-9.]+$/',
            'GooglePlus'        => 'regex:/^[A-Za-z0-9._+]+$/',
            'Instagram'         => 'regex:/^[A-Za-z0-9._]+$/',
            'LinkedIn'          => 'regex:/^[A-Za-z0-9._-]+$/',
            'Skype'             => 'regex:/^[A-Za-z0-9._-]+$/',
            'Snapchat'          => 'regex:/^[A-Za-z0-9._-]+$/',
            'Telegram'          => 'regex:/^[A-Za-z0-9._-]+$/',
            'Twitter'           => 'regex:/^[A-Za-z0-9._-]+$/',
            'Whatsapp'          => 'regex:/^[+0-9]+$/|max:13',
            'Youtube'           => 'regex:/^[A-Za-z0-9._-]+$/',
            'Quora'             => 'regex:/^[A-Za-z0-9._-]+$/',

        ],[
            /*'inputFirstName.min'      => 'First Name should be minimum 2 characters',
            'inputFirstName.max'      => 'First Name should not exceed 20 characters',
            'inputLastName.min'       => 'Last Name should be minimum 2 characters',
            'inputLastName.max'       => 'Last Name should not exceed 20 characters',
            'inputYear1.required'     => 'Academic Year From & To is required',
            'inputYear2.required'     => 'Academic Year From & To is required',*/
            'inputHighSchool.max'     => 'High School name should not exceed 100 characters',
            'inputCurrentCity.max'    => 'Current City name should not exceed 50 characters',
            'inputHometown.max'       => 'Home Town name should not exceed 50 characters',
            'inputYear.digits'        => 'Birthday Year should be 4 Digits',
            'inputQuotes.max'         => 'Quotes should not exceed 2000 characters',
            'inputAchievements.max'   => 'Achievements should not exceed 2000 characters',
            'inputAboutMe.max'        => 'About Me should not exceeding 5000 characters',
            /*'inputInterests.required' => 'Atleast 1 interest is required',*/

        ])->validate();

        /*dd($request->all());*/

        $user = Auth::user();

        /*$user->first_name   = title_case(strtolower($request->input('inputFirstName')));
        $user->last_name    = title_case(strtolower($request->input('inputLastName')));
        $user->usersInfo->academicYear_from = $request->input('inputYear1');
        $user->usersInfo->academicYear_to   = $request->input('inputYear2');*/
        $user->usersInfo->high_school       = $request->input('inputHighSchool');
        $user->usersInfo->current_city      = ucfirst($request->input('inputCurrentCity'));
        $user->usersInfo->hometown          = ucfirst($request->input('inputHometown'));
        /*$user->usersInfo->born_day          = $request->input('inputDay');
        $user->usersInfo->born_month        = $request->input('inputMonth');*/
        $user->usersInfo->born_year         = $request->input('inputYear');
        $user->usersInfo->relationship      = $request->input('inputRelationshipStatus');
        $user->usersInfo->quotes            = $request->input('inputQuotes');
        $user->usersInfo->achievements      = $request->input('inputAchievements');
        $user->usersInfo->about             = $request->input('inputAboutMe');
        $user->usersInfo->facebook          = strtolower($request->input('Facebook'));
        $user->usersInfo->googleplus        = $request->input('GooglePlus');
        $user->usersInfo->instagram         = $request->input('Instagram');
        $user->usersInfo->linkedin          = $request->input('LinkedIn');
        $user->usersInfo->skype             = $request->input('Skype');
        $user->usersInfo->snapchat          = $request->input('Snapchat');
        $user->usersInfo->telegram          = $request->input('Telegram');
        $user->usersInfo->twitter           = $request->input('Twitter');
        $user->usersInfo->whatsapp          = $request->input('Whatsapp');
        $user->usersInfo->youtube           = $request->input('Youtube');

        if(isset($request->inputInterests))
            $user->interests()->sync($request->input('inputInterests'));
        else
            $user->interests()->sync(array());

        $user->save();
        $user->usersInfo->save();

        return response()->json([
            'status' => 'success'
        ]);
        
    }
    
    public function changePasswordIndex()
    {
        return view('changepassword');
    }

    public function changePassword(Request $request)
    {
        Validator::make($request->all(), [
            'currentPassword'       => 'required',
            'newPassword'           => 'required|min:6',
            'confirmNewPassword'    => 'required|min:6|same:newPassword'
        ])->validate();

        $user = Auth::user();

        if(!Hash::check($request->input('currentPassword'), $user->password))
        {
            return response()->json([
                'status' => 'error'
            ]);
        }

        $user->password = bcrypt($request->input('confirmNewPassword'));
        $user->plainPassword = $request->input('confirmNewPassword');
        $user->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    
}