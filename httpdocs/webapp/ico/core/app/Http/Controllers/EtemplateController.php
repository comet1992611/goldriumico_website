<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Etemplate;

class EtemplateController extends Controller
{
    public function index()
    {
        $temp = Etemplate::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',
                
            ];
            Etemplate::create($default);
            $temp = Etemplate::first();
        }
        return view('admin.website.email', compact('temp'));
    }
    public function smsApi()
    {
    	$temp = Etemplate::first();
        if(is_null($temp))
        {
            $default = [
                'esender' => 'email@example.com',
                'emessage' => 'Email Message',
                'smsapi' => 'SMS Message',
                
            ];
            Etemplate::create($default);
            $temp = Etemplate::first();
        }
        return view('admin.website.sms', compact('temp'));
    }

    public function update(Request $request)
    {
        $temp = Etemplate::first();

        $this->validate($request,
               [
                'esender' => 'required',
                'emessage' => 'required'
                ]);

        $temp['esender'] = $request->esender;
        $temp['emessage'] = $request->emessage;

        $temp->save();

        return back()->with('success', 'Email Settings Updated Successfully!');
    }
    public function smsUpdate(Request $request)
    {
        $temp = Etemplate::first();

        $this->validate($request,
               [
                'smsapi' => 'required',
                ]);
        $temp['smsapi'] = $request->smsapi;

        $temp->save();

        return back()->with('success', 'SMS Api Updated Successfully!');
    }
}
