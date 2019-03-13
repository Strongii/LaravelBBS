<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['except'=>['show']]);
    }
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('Users.edit',compact('user'));
    }
    public function update(UserRequest $request,User $user,ImageUploadHandler $uploader){
        $this->authorize('update', $user);
        $user->update($request->all());
        if($request->avatar){
            $result = $uploader->save($request->avatar,'avatars',$user->id,362,362);
            if($result){
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功！');
    }
}
