<?php
/**
 * Created by PhpStorm.
 * User: hero
 * Date: 2019/3/24
 * Time: 21:45
 */

namespace App\Models\Traits;
use Illuminate\Support\Facades\Redis;

trait SignIn
{
    public function getSignStatus($user_id){
        $daykey = now()->format('Ymd');
        $signInStatus = Redis::getbit($daykey,$user_id);
        return $signInStatus;
    }
}