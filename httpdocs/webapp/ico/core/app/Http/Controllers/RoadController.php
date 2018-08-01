<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\Road;
use Illuminate\Http\Request;

class RoadController extends Controller
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
              'road_title' => 'Dummy Text',
              'road_details' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        $roads = Road::all();
        return view('admin.front.road', compact('roads','frontend'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
           [
               'title' => 'required',
               'details' => 'required',
           ]);
        $road['title'] = $request->title;
        $road['details'] = $request->details;
        Road::create($road);

        return back()->with('success', 'New Road Map Item Created');
    }


    public function update(Request $request, Road $road)
    {
        $this->validate($request,
           [
               'title' => 'required',
               'details' => 'required',
           ]);
        $road['title'] = $request->title;
        $road['details'] = $request->details;
        $road->save();

        return back()->with('success', 'Road Map Item Updated');
        
    }

    public function destroy(Road $road)
    {
        $road->delete();
        return back()->with('success', 'Road Map Item Deleted');
    }
}
