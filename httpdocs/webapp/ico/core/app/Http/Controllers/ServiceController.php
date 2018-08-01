<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
              'serv_title' => 'Dummy Text',
              'serv_details' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }

        $services = Service::all();
        return view('admin.front.service', compact('services','frontend'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
           [
               'icon' => 'required',
               'title' => 'required',
               'details' => 'required',
           ]);
        $serv['icon'] = $request->icon;
        $serv['title'] = $request->title;
        $serv['details'] = $request->details;
        Service::create($serv);

        return back()->with('success', 'New Service  Item Created');
    }


    public function update(Request $request, Service $service)
    {
        $this->validate($request,
           [
               'icon' => 'required',
               'title' => 'required',
               'details' => 'required',
           ]);
        $service['icon'] = $request->icon;
        $service['title'] = $request->title;
        $service['details'] = $request->details;
        $service->save();

        return back()->with('success', 'Service Item Updated');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service Item Deleted');
    }
}
