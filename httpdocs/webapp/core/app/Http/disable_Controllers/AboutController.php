<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    public function show()
    {
    	$about = About::find(1);
        if($about == null)
        {
            $default=[
                'heading' => 'About Us',
                'details' => 'Details about us',
            ];
            About::create($default);
        }
    	return view('admin.interface.about', compact('about'));
    }

    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$about = About::find($id);

        $about['heading'] = $request->heading;
        $about['details'] = $request->details;
        $about['video'] = $request->video;

        $about->save();

        return back()->withSuccess('About Details Updated successfully.');
    }
}
