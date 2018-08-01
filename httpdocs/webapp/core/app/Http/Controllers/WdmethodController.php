<?php

namespace App\Http\Controllers;

use App\Wdmethod;
use Illuminate\Http\Request;

class WdmethodController extends Controller
{

    public function index()
    {
        $methods = Wdmethod::all();
        return view('admin.withdraw.wdmethod', compact('methods'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required',
                'prtime' => 'required',
                'minamo' => 'required',
                'maxamo' => 'required',
                'chargefx' => 'required',
                'chargepc' => 'required',
                'status' => 'nullable'
            ]);

         if($request->hasFile('logo'))
        {

            $method['logo'] = uniqid().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move('assets/images/wdmethod',$method['logo']);
        }
        $method['name'] = $request-> name;
        $method['prtime'] = $request-> prtime;
        $method['minamo'] = $request-> minamo;
        $method['maxamo'] = $request-> maxamo;
        $method['chargefx'] = $request-> chargefx;
        $method['chargepc'] = $request-> chargepc;
        $method['status'] = $request-> status;
       

        Wdmethod::create($method);

        return back()->with('success', 'New Withdraw Method Created Successfully!');
    }

    
    public function update(Request $request, $id)
    {
        $method = Wdmethod::find($id);

        $this->validate($request,
            [
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required',
                'prtime' => 'required',
                'minamo' => 'required',
                'maxamo' => 'required',
                'chargefx' => 'required',
                'chargepc' => 'required',
                'status' => 'nullable'
            ]);

         if($request->hasFile('logo'))
        {

            $method['logo'] = uniqid().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move('assets/images/wdmethod',$method['logo']);
        }
        $method['name'] = $request-> name;
        $method['prtime'] = $request-> prtime;
        $method['minamo'] = $request-> minamo;
        $method['maxamo'] = $request-> maxamo;
        $method['chargefx'] = $request-> chargefx;
        $method['chargepc'] = $request-> chargepc;
        $method['status'] = $request-> status;
        
        $method->save();

        return back()->with('success', 'Withdraw Method Updated Successfully!');
    }

}
