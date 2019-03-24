<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignController extends Controller
{
    public function sign(Request $request){
        $redis = app('redis.connection');
        $daykey = now()->format('Ymd');
        $user_id = $this->user->id;
        return $user_id;
//        $redis->bitset();
    }
}
