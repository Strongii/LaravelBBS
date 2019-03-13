<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CapchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaptchasController extends Controller
{
    public function store(CapchaRequest $request,CaptchaBuilder $captchaBuilder){
        $key = 'captcha_'.str_random(15);
        $phone = $request->phone;
        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(2);
        \Cache::put($key,['phone'=>$phone,'code'=>$captcha->getPhrase()],$expiredAt);
        $result = [
            'captcha_key'=>$key,
            'expired_at'=>$expiredAt->toDateTimeString(),
            'captcha_image_contenmt'=>$captcha->inline()
        ];
        return $this->response->array($result)->setStatusCode(201);
    }
}
