<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Gsetting;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $gset = Gsetting::first();

              return User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'mobile' => $data['mobile'],
                    'balance' => '00',
                    'status' => 1,
                    'bitcoin' => '00',
                    'docv' => 0,
                    'gtfa' => 0,
                    'tfav' => 1,
                    'emailv' =>  $gset->emailVerify,
                    'smsv' =>  $gset->smsVerify,
            ]);


    }
}
