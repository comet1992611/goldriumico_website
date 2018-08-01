<?php

namespace App\Providers;

use App\General;
use App\Ico;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

       $gnl = General::first();
        if($gnl == null)
        {
            $default = [
                'title' => 'THESOFTKING',
                'subtitle' => 'Subtitle',
                'startdate' => '2017-12-29',
                'color' => '009933',
                'cur' => 'BDT',
                'cursym' => 'TK',
                'decimal' => '2',
                'reg' => '1',
                'emailver' => '0',
                'smsver' => '1',
                'emailnotf' => '0',
                'smsnotf' => '1'
            ];
            General::create($default);
            $gnl = General::first();
        }
        view()->share('gnl',  $gnl);

       $first = Ico::where('status',1)->first();
       if(is_null($first))
       {
        $icorate =0;
       }
       else
       {
        $icorate =$first->price;
       }
       view()->share('icorate',  $icorate);

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
