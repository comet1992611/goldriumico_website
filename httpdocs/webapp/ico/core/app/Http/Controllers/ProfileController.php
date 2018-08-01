<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','ckstatus']);
    }
    public function index()
    {
    	$profile = User::find(Auth::id());;
    
    	return view('user.profile', compact('profile'));
    }

   public function update(Request $request)
   {
  
     	$this->validate($request,
           [
               'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
               'name' => 'required'
            
           ]);
   		$profile = User::find(Auth::id());
        $profile['name'] = $request->name;


       if($request->hasFile('photo'))
        {
            if($profile->photo != 'nopic.png'){
            
        	$path = 'assets/images/profile/'.$profile->photo;
	        if(file_exists($path))
	        {
	            unlink($path);
	        }
            }
	        
            $profile['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/profile',$profile['photo']);
        }
    
        $profile['country'] = $request->country;
        $profile['city'] = $request->city;
        $profile['address'] = $request->address;
        $profile['zip'] = $request->zip;
        $profile->save();
      
        return back()->with('success', 'Profile  Updated Successfully!');
    }
}
