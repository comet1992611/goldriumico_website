<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Footer;

class FooterController extends Controller
{
    public function show()
    {
    	$footer = Footer::find(1);
        
        if($footer == null)
        {
            $default=[
                'heading' => 'THESOFTKING',
                'text' => 'All Rights Reserved'
            ];
            Footer::create($default);
        }   	
    	return view('admin.interface.footer', compact('footer'));
    }

    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$footer = Footer::find($id);

        $this->validate($request, [
            'heading' => 'nullable',
            'text' => 'nullable'         
        ]);

        $footer['heading'] = $request-> heading;
        $footer['text'] = $request-> text;         

        $footer->save();

        return back()->with('success','Footer Content Updated successfully.');
    }
}
