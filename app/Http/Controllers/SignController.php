<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Routing\Route;

class SignController extends Controller
{
    public function sign(Request $request){

        $daykey = now()->format('Ymd');
        //$signStatus = Redis::del($daykey);
        $user_id = Auth::id();
        $signStatus = Redis::setbit($daykey,$user_id,1);
        return redirect()->route('topics.index',compact($signStatus));
    }
}
