<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docver;
use App\User;
use App\Tranlimit;

class DocverController extends Controller
{
    public function requests()
    {
        $tranl = Tranlimit::first();
    	$docs = Docver::orderBy('id', 'desc')->paginate(10);

    	return view('admin.document.index', compact('docs','tranl'));
    }

    public function approve(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$user = User::findOrFail($id);

    	$user['docv'] = $request->docv =="1" ?1:0 ;

    	$user->save();

        $msg =  'Your Document Verified Successfully';
        send_email($user->email, $user->username, 'Document Verified', $msg);
        $sms =  'Your Document Verified Successfully';
        send_sms($user->mobile, $sms);


    	return back()->withSuccess('Document Verification Successful');

    }
}
