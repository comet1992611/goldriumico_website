<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo;

class LogoController extends Controller
{
    public function show()
    {
    	$logo = Logo::find(1);	

        if($logo == null)
        {
            $default=[
                'logo' => 'logo.png',
                'icon' => 'icon.png'
            ];
            Logo::create($default);
        }   

    	return view('admin.interface.logo', compact('logo'));
    }

    public function update(Request $request, $id)
    {
    	$logo = Logo::find($id);

        $this->validate($request, [
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',         
        ]);

        if($request->hasFile('logo'))
        {
            $logo['logo'] = 'logo.png';
            $request->logo->move('assets/images/logo',$logo['logo']);
        }
        if($request->hasFile('icon'))
        {
            $logo['icon'] = 'icon.png';
            $request->icon->move('assets/images/logo',$logo['icon']);
        }

        $logo->save();

        return back()->with('success','Logo and Icon Updated successfully.');
    }
}
