<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;


class UsersController extends Controller
{
    public function update(UserRequest $request){

        $user = $this->user();
        $attributes = $request->only(['name', 'email', 'introduction']);
        if($request->avatar_image_id){
            $image = Image::find($request->avatar_image_id);
            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);
        return $this->response->item($user,new UserTransformer());
    }
    public function me(){
        return $this->response->item($this->user,new UserTransformer());
    }

    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => bcrypt($request->password),
        ]);

        \Cache::forget($request->verification_key);
//        \Auth::guard('api')->refresh();

        return $this->response->item($user,new UserTransformer())->setMeta([
            'access_token'=>\Auth::guard('api')->fromUser($user),
            'token_type'=>'Bearer',
            'expores_in'=>\Auth::guard('api')->factory()->getTTL() * 60,

        ])->setStatusCode(201);
    }



}
