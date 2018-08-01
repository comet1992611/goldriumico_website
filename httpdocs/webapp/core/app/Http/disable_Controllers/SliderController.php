<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    public function index()
    {
         $slide = Slider::first();
         return view('admin.interface.slider', compact('slide'));
    }

    public function update(Request $request)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $slide = Slider::first();
        $this->validate($request,
            [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
            ]);

       if($request->hasFile('image'))
        {
             $path = 'assets/images/slider/'.$slide->image;

                if(file_exists($path))
                {
                    unlink($path);
                }
                
            $slide['image'] = uniqid().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('assets/images/slider',$slide['image']);
        }

        $slide['bold'] = $request->bold;
        $slide['small'] = $request->small;
        $slide->save();

        return back()->with('success', 'Banner Updated Successfully!');
    }

}
