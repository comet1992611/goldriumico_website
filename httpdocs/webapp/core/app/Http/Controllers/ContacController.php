<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contac;

class ContacController extends Controller
{
    public function show()
    {
    	$contac = Contac::find(1);
        if($contac == null)
        {
            $default=[
                'email' => 'example@email.com',
                'mobile' => '0183839',
                'location' => 'Dhaka, Bangladesh'   
            ];
            Contac::create($default);
        }	
    	return view('admin.interface.contac', compact('contac'));
    }

    public function update(Request $request, $id)
    {
    	$contac = Contac::find($id);

        $this->validate($request, [
            'email' => 'nullable',
            'mobile' => 'nullable',
            'location' => 'nullable'         
        ]);

        $contac['email'] = $request-> email;
        $contac['mobile'] = $request-> mobile;         
        $contac['location'] = $request-> location;

        $contac->save();

        return back()->withSuccess('Contact Info Updated successfully.');
    }
}
