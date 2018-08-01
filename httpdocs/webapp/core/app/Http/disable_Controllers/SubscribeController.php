<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribe;

class SubscribeController extends Controller
{
   public function store(Request $request)
   { return back()->with('alert', 'Demo Version. Can Not Change');
   	 	$this->validate($request,
            [
                'email' => 'required|email'
            ]);

      $subscribe['email'] = $request->email;

      Subscribe::create($subscribe);

      return back();  
   }
}
