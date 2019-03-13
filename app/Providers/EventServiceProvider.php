<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\Weixin\WeixinExtendSocialite@handle'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}


//php artisan make:migration add_weixin_openid_to_users_table --table=users



//$accessToken = '13_6h083V8qH0RVQxlx4UHJ7JNMY_drh5gUzWIvrTAO0ch2C2GKlOTt_MYGDNtkgvyXiIj8GqL68daxDLmZFBP7ng';
//$openID = 'oKmrz1H4ZiKBlgz_5QeCXGzip8CI';
//$driver = Socialite::driver('weixin');
//$driver->setOpenId($openID);
//$oauthUser = $driver->userFromToken($accessToken);






