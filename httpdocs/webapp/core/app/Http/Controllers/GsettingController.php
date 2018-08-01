<?php

namespace App\Http\Controllers;

use App\Gsetting;
use Illuminate\Http\Request;

class GsettingController extends Controller
{


    public function index()
    {
        $gsettings = Gsetting::find(1);
        if($gsettings == null)
        {
            $default = [
                'webTitle' => 'THESOFTKING',
                'subtitle' => 'Subtitle',
                'startdate' => '12/10/2017',
                'colorCode' => '009933',
                'curCode' => 'BDT',
                'curSymbol' => 'TK',
                'decimalPoint' => '2',
                'registration' => '1',
                'emailVerify' => '0',
                'smsVerify' => '1',
                'emailNotify' => '0',
                'smsNotify' => '1',
            ];
            Gsetting::create($default);
        }
        return view('admin.dashboard.general', compact('gsettings'));
    }

    public function email()
    {

        $gsettings = Gsetting::find(1);
        if($gsettings == null)
        {
            $default = [
                'webTitle' => 'THESOFTKING',
                'colorCode' => '009933',
                'emailSender' => 'example@email.com',
                'emailMessage' => 'Lorem Ipsum',
            ];
            Gsetting::create($default);
        }
        return view('admin.dashboard.email', compact('gsettings'));
    }

     public function sms()
    {
        $gsettings = Gsetting::find(1);
        if($gsettings == null)
        {
            $default = [
                'webTitle' => 'THESOFTKING',
                'colorCode' => '009933',
                'smsApi' => 'THESOFTKING',

            ];
            Gsetting::create($default);
        }
        return view('admin.dashboard.sms', compact('gsettings'));
    }

    public function update(Request $request, $id)
    {
        $settings = Gsetting::find($id);

        $this->validate($request,
               [
                'webTitle' => 'required',
                ]);

        $settings['webTitle'] = $request->webTitle;
        $settings['subtitle'] = $request->subtitle;
        $settings['startdate'] = $request->startdate;
        $settings['colorCode'] = $request->colorCode ;
        $settings['curCode'] = $request->curCode ;
        $settings['curSymbol'] = $request->curSymbol;
        $settings['decimalPoint'] = $request->decimalPoint;
        $settings['registration'] = $request->registration =="1" ?1:0 ;
        $settings['emailVerify'] = $request->emailVerify =="1" ?0:1 ;
        $settings['smsVerify'] = $request->smsVerify =="1" ?0:1 ;
        $settings['emailNotify'] = $request->emailNotify=="1" ?1:0;
        $settings['smsNotify'] = $request->smsNotify=="1" ?1:0;

        $settings->save();

        return back()->with('success', 'General Settings Updated Successfully!');
    }

     public function smsupdate(Request $request, $id)
    {
        $settings = Gsetting::find($id);

        $this->validate($request,
               [
                'smsApi' => 'nullable'
                ]);

        $settings['smsApi'] = $request-> smsApi;

        $settings->save();

        return back()->with('success', 'SMS API Settings Updated Successfully!');
    }


     public function emailupdate(Request $request, $id)
    {
        $settings = Gsetting::find($id);

        $this->validate($request,
               [
                'emailSender' => 'required',
                'emailMessage' => 'required'
                ]);

        $settings['emailSender'] = $request-> emailSender;
        $settings['emailMessage'] = $request-> emailMessage;

        $settings->save();

        return back()->with('success', 'Email Template Updated Successfully!');
    }
}
