<?php
/**
 * Created by PhpStorm.
 * User: Rohan
 * Date: 17-05-2017
 * Time: 05:26 PM
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendComposer
{
    public $friendList, $pendingList, $requestedList, $mutualFriends;

    public function __construct()
    {
        $this->friendList = DB::table('friend_user')
                                ->where(function ($query) {
                                    $query->where('user_id',Auth::user()->id)
                                        ->orWhere('friend_id',Auth::user()->id);
                                })
                                ->where('approved', 1)
                                ->count();

        $this->pendingList = DB::table('friend_user')
                                ->where('friend_id',Auth::user()->id)
                                ->where('approved', 0)
                                ->count();

        $this->requestedList = DB::table('friend_user')
                                ->where('user_id',Auth::user()->id)
                                ->where('approved', 0)
                                ->count();

    }

    public function compose(View $view)
    {
        $view->with([
            'countFriends' =>$this->friendList,
            'countPendingFriends' =>$this->pendingList,
            'countRequestedFriends' =>$this->requestedList,
        ]);
    }
}