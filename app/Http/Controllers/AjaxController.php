<?php

namespace App\Http\Controllers;

use App\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function programmes($id)
    {

        $programmes = Programme::where('institute_id','=',$id)->get();

        return json_encode($programmes);
    }

    public function deletephoto(Request $request)
    {
        $user = Auth::user();

        if (file_exists(public_path('/uploads/avatars/'.$user->reg_no.'/'.$request->image)))
        {
            if($request->image == $user->usersInfo->avatar){

                $user->usersInfo->avatar = null;
                $user->usersInfo->save();
            }

            unlink((public_path('/uploads/avatars/'.$user->reg_no.'/'.$request->image)));

            return response()->json(['status' => 'success']);
        }
        else{
            return response()->json(['status' => 'error']);
        }
    }
}