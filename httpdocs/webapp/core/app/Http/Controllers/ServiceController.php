<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Testimonial;

class ServiceController extends Controller
{
    public function show()
    {
    	$service = Service::first();
        if($service == null)
        {
            $default=[
                'heading' => 'Services',
            ];
            Service::create($default);
        }

        $testims = Testimonial::all();
    	return view('admin.interface.service', compact('service','testims'));
    }

    public function update(Request $request)
    {
    	$service = Service::first();

        $this->validate($request, [
            'heading' => 'required',  
        ]);
        $service['heading'] = $request->heading;    
        $service->save();
        return back()->withSuccess('service Details Updated successfully.');
    }
}
