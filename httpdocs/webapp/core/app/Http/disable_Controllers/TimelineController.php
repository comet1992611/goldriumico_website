<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;
class TimelineController extends Controller
{
    public function index()
    {
        $times = Timeline::all();

        return view('admin.interface.timeline', compact('times'));
    }


    public function store(Request $request)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $this->validate($request,
            [
                'title' => 'required',
                'desc' => 'required',
                'date' => 'required'
            ]);

        $time['title'] = $request->title;
        $time['desc'] = $request->desc;
        $time['date'] = $request->date;

        Timeline::create($time);

        return redirect()->route('timeline')->with('success', 'New Timeline Created Successfully!');
    }

    public function addnew()
    {
    	return view('admin.layouts.addtimeline');
    }

    public function edit($id)
    {
        $time = Timeline::find($id);

        return view('admin.interface.timeedit', compact('time'));
    }

    
    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $time = Timeline::find($id);

        $this->validate($request,
            [
                'title' => 'required',
                'desc' => 'required',
                'date' => 'required'
            ]);

        $time['title'] = $request->title;
        $time['desc'] = $request->desc;
        $time['date'] = $request->date;
        $time->save();

        return redirect()->route('timeline')->with('success', 'Timeline Updated Successfully!');
    }

    
    public function destroy(Timeline $timeline)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $timeline->delete();

        return back()->with('success', 'Timeline Updated Deleted Successfully!');
    }
}
