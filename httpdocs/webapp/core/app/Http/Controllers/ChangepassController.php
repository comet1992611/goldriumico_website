<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use App\Admin;
use Hash;
use Auth;
use Session;

class ChangepassController extends Controller
{
    public function changepass()
    {
      return view('admin.auth.changepass');
    }

    public function chnpass()
    {
      $user = Auth::guard('admin')->user();

      if(Hash::check(Input::get('passwordold'), $user['password']) && Input::get('password') == Input::get('password_confirmation'))
      {
        $user->password = bcrypt(Input::get('password'));
        $user->save();
        return back()->with('success', 'Password Changed');
      }
      else {
        {
          return back()->with('alert', 'Password Not Changed');
        }
      }
    }
}
