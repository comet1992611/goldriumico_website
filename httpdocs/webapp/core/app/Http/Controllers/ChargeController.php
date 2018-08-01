<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charge;

class ChargeController extends Controller
{
     public function index()
     {
     	$charges = Charge::find(1);
       
        if($charges==null)
        {
            $charges =Charge::create([
                'trancharge' => '00',
                'trncrgp' => '00',
                'basep' => '00',
                'varp' => '00',
                'convcrg' => '00',
                'supply' => '00'
        ]);
        }

     	return view('admin.policy.charge', compact('charges'));
     }

     public function update(Request $request, $id)
    {
        $charges = Charge::find($id);

         $this->validate($request, 
               [
                'trancharge' => 'required',
                'trncrgp' => 'required',
                'basep' => 'required',
                'varp' => 'required',
                'convcrg' => 'required',      
                'supply' => 'required'      
                ]);

         $charges['trancharge'] = $request->trancharge;
         $charges['trncrgp'] = $request->trncrgp;
         $charges['basep'] = $request->basep;
         $charges['varp'] = $request->varp;
         $charges['convcrg'] = $request->convcrg;
	     $charges['supply'] = $request->supply;

	     $charges->save();

       return redirect()->back()->with('success', 'Charges Updated Successfully!');
    }
}
