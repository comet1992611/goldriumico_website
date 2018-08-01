<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;

class SocialController extends Controller
{

    public function index()
    {
        $social = Social::all();

        return view('admin.interface.social', compact('social'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'facode' => 'required',
                'faurl' => 'required'
            ]);

        $social['facode'] = $request-> facode;
        $social['faurl'] = $request-> faurl;

        Social::create($social);

        return back()->with('success', 'New Social Account Created Successfully!');
    }

    
    public function update(Request $request, $id)
    {
        $social = Social::find($id);

        $this->validate($request,
            [
               'facode' => 'required',
               'faurl' => 'required'
            ]);

        $social['facode'] = $request-> facode;
        $social['faurl'] = $request-> faurl;


        $social->save();

        return back()->with('success', 'Social Account Updated Successfully!');
    }

    
    public function destroy(Social $social)
    {
        $social->delete();

        return back()->with('success', 'Social Account Deleted Successfully!');
    }
}
