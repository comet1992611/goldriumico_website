<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\Testim;
use Illuminate\Http\Request;

class TestimController extends Controller
{
   public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
              'testm_title' => 'Dummy Text',
              'testm_details' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        $testims = Testim::all();
        return view('admin.front.testim', compact('testims','frontend'));
    }

  
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required',
                'company' => 'required',
                'comment' => 'required',
            ]);

         if($request->hasFile('photo'))
        {
            $testim['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/testimonial',$testim['photo']);
        }
        $testim['name'] = $request->name;
        $testim['company'] = $request->company;
        $testim['comment'] = $request->comment;
        

        Testim::create($testim);

        return back()->with('success', 'New Testimonial Created Successfully!');
    }

  
    public function update(Request $request, $testim)
    {
    	$testim = Testim::find($testim);
          $this->validate($request,
            [
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required',
                'company' => 'required',
                'comment' => 'required',
            ]);

        if($request->hasFile('photo'))
        {
            $path = 'assets/images/testimonial/'.$testim->photo;
	        if(file_exists($path))
	        {
	            unlink($path);
	        }
            $testim['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/testimonial',$testim['photo']);
        }
        $testim['name'] = $request->name;
        $testim['company'] = $request->company;
        $testim['comment'] = $request->comment;
       
        $testim->save();
        return back()->with('success', 'Testimonial Updated Successfully!');
    }

  
    public function destroy(Testim $testim)
    {
        $path = 'assets/images/testimonial/'.$testim->photo;
        if(file_exists($path))
        {
            unlink($path);
        }
        $testim->delete();
        return back()->with('success', 'Testimonial Deleted Successfully!');
    }
}
