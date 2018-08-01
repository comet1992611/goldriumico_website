<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;

class GatewayController extends Controller
{
    public function show()
    {
    	$gateway = Gateway::find(5);
        
        if(is_null($gateway))
        {
            $default=[
                'gateimg' => 'paypal.png',
                'name' => 'PayPal',
                'minamo' => '100',
                'maxamo' => '100000',
                'charged' => '10',
                'chargep' => '11',
                'rate' => '21',
                'val1' => 'JHuiqejhkjq',
                'val2' => '24897HHd',
                'currency' => 'USD',
                'status' => '1'
            ];

            Gateway::create($default);
        }       
    	
    	return view('admin.deposit.gateway', compact('gateway'));

    }

    public function update(Request $request)
    {
    	$gateway = Gateway::findorFail(5);

        $this->validate($request, [
            'gateimg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'val1' => 'nullable',
            'val2' => 'nullable',
            'status' => 'nullable'
        ]);

        if($request->hasFile('gateimg'))
        {
            $path = 'assets/images/gateway/'.$gateway->gateimg;

                if(file_exists($path))
                {
                    unlink($path);
                }
                
            $gateway['gateimg'] = uniqid().'.'.$request->gateimg->getClientOriginalExtension();
            $request->gateimg->move('assets/images/gateway',$gateway['gateimg']);
        }

        $gateway['name'] = $request->name;
        $gateway['minamo'] = '0';
        $gateway['maxamo'] = '0';
        $gateway['charged'] = '0';
        $gateway['chargep'] = '0';
        $gateway['rate'] = '0';
        $gateway['val1'] = $request->val1;
        $gateway['val2'] = $request->val2;
        $gateway['currency'] = '0';
        $gateway['status'] = $request->status;

        $gateway->save();

        return back()->with('success','Gateway Information Updated successfully.');
    }
}
