<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statistic;

class StatisticController extends Controller
{
    public function show()
    {
    	$stats = Statistic::all();
    	return view('admin.interface.stat', compact('stats'));
    }

    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$stats = Statistic::find($id);

        $this->validate($request, [
            'icon' => 'nullable',
            'bold' => 'nullable',
            'small' => 'nullable'         
        ]);

        $stats['icon'] = $request-> icon;
        $stats['bold'] = $request-> bold;         
        $stats['small'] = $request-> small;

        $stats->save();

        return back()->with('success','Statistics Updated successfully.');
    }
}
