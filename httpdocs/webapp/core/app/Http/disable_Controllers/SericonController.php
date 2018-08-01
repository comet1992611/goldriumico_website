<?php

namespace App\Http\Controllers;

use App\Sericon;
use Illuminate\Http\Request;

class SericonController extends Controller
{

    public function store(Request $request)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $this->validate($request,
            [
                'icon' => 'required',
                'name' => 'required'
            ]);

        $icon['icon'] = $request-> icon;
        $icon['name'] = $request-> name;

        Sericon::create($icon);

        return back()->with('success', 'New Service Created Successfully!');
    }


    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
       $icon = Sericon::find($id);

        $this->validate($request,
            [
               'icon' => 'required',
               'name' => 'required'
            ]);

        $icon['icon'] = $request-> icon;
        $icon['name'] = $request-> name;


        $icon->save();

        return back()->with('success', 'Service Updated Successfully!');
    }


    public function destroy(Sericon $sericon)
    { return back()->with('alert', 'Demo Version. Can Not Change');
       $sericon->delete();

        return back()->with('success', 'Service Deleted Successfully!');
    }
}
