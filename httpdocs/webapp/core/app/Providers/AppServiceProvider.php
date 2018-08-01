<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Gsetting;
use App\Footer;
use App\Price;
use App\User;
use App\Contac;
use Auth;


class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Schema::defaultStringLength(191);

        //General
        $gset = Gsetting::first();
        if (is_null($gset)) {
           $gset = Gsetting::create([
                'webTitle' => 'THESOFTKING',
                'colorCode' => '009933',
                'curCode' => 'BDT',
                'curSymbol' => 'TK',
                'registration' => '1',
                'emailVerify' => '0',
                'smsVerify' => '1',
                'emailNotify' => '0',
                'smsNotify' => '1',    
               ]);
       }
        view()->share('gset',  $gset);

        //Contact
        $contact = Contac::first();
        if (is_null($contact)) {
           $gset = Contac::create([
                'email' => 'example@email.com',
                'mobile' => '0172625121',
                'location' => 'Dhaka, Bangladesh',
               ]);
       }
        view()->share('contact',  $contact);

        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcrate = $res->USD->last;
        $price = Price::latest()->first();
        $crate = $price->price * 1;

        view()->share('btcrate',  $btcrate);
        view()->share('crate', $crate);

        // Footer
        view()->composer('front.layouts.footer', function($view)
        {
          $view->with('footer', \App\Footer::first());
        }); 

        //Total User
        view()->composer('admin.home', function($view)
        {
          $view->with('totalusers', \App\User::where('status','1')->count());
        }); 

        //User Deposit Request
        view()->composer('admin.home', function($view)
        {
          $view->with('depositreq', \App\Deposit::where('status', '0')->count());
        }); 

        // Withdraw Requests
        view()->composer('admin.home', function($view)
        {
          $view->with('withdrawreq', \App\Withdraw::where('status', '0')->count());
        }); 

  
        // Avatar
        view()->composer('front.layouts.sidebar', function($view)
        {
          $view->with('avatar', \App\Avatar::where('user_id', Auth::id())->pluck('photo')->first());
        }); 

    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
