<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payintro;
class PayintroController extends Controller
{
   

    public function update(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$payin = Payintro::find($id);

        $this->validate($request, [
            'heading' => 'required',
            'details' => 'required'      
        ]);

        $payin['heading'] = $request-> heading;
        $payin['details'] = $request-> details;         
      
        $payin->save();

        return back()->withSuccess('Payment Intro Updated successfully.');
    }
}
