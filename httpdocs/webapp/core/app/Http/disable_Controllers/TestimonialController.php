<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function store(Request $request)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $this->validate($request,
            [
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

         if($request->hasFile('photo'))
        {
            $testim['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/testimonial',$testim['photo']);
        }
        $testim['company'] = $request->company;
        $testim['comment'] = $request->comment;
        

        Testimonial::create($testim);

        return back()->with('success', 'New Testimonial Created Successfully!');
    }


    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
          $testim = Testimonial::find($id);

          $this->validate($request,
            [
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company' => 'nullable',
                'comment' => 'nullable',
            ]);

         if($request->hasFile('photo'))
        {
            unlink('assets/images/testimonial/'.$testim->photo);
            $testim['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/testimonial',$testim['photo']);
        }
        $testim['company'] = $request->company;
        $testim['comment'] = $request->comment;
       
       $testim->save();

        return back()->with('success', 'Testimonial Updated Successfully!');
    }
    
    public function destroy(Testimonial $testim)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $testim->delete();
        unlink('assets/images/testimonial/'.$testim->photo);
        return back()->with('success', 'Testimonial Deleted Successfully!');
    }
}
