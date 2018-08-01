<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{


     public function postLogin(Request $request)
    {

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
                    ]))
         {

            $logg = User::findOrFail(Auth::user()->id);

            if(Auth::user()->gtfa==1){
                $logg['tfav'] = 0;
            }else{
                $logg['tfav'] = 1;

            }
            $logg->save();
            return redirect('/home');

        }

        $request->session()->flash('alert', 'Login  incorrect!');
        return redirect()->back();
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
