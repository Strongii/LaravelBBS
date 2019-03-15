<?php

namespace App\Observers;

use App\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }
    public function saving(User $user){
        if (empty($user->avatar)) {
            $user->avatar = 'http://www.yutudou.com/uploads/allimg/170809/1-1FP9221236.jpg';
        }
    }
}