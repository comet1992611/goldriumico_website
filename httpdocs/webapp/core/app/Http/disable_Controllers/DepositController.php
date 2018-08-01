<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Deposit;
use App\User;
use App\Uwdlog;
use App\Gsetting;

class DepositController extends Controller
{
    public function index()
    {
    	$deposits = Deposit::where('status', 1)->orderBy('id', 'desc')->get();

    	return view('admin.deposit.deposits', compact('deposits'));
    }

    public function requests()
    {
    	$deposits = Deposit::where('status', 0)->orderBy('id', 'desc')->get();

    	return view('admin.deposit.requests', compact('deposits'));
    }

     public function approve(Request $request, $id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $deposit = Deposit::findorFail($id);
        $setting = Gsetting::first();

        $deposit['status'] = 1;
        $user = User::find($deposit['user_id']);
        $user['balance'] = $user->balance + $deposit['amount'];
        $user->save();

        $deposit->save();

        $ulog['user_id'] = $user->id;
        $ulog['trxid'] = $deposit['trxid'];
        $ulog['amount'] = $deposit['amount'];
        $ulog['flag'] = 1;
        $ulog['status'] = 1;
        $ulog['balance'] = $user['balance'];
        $ulog['desc'] = 'Purchased';

        Uwdlog::create($ulog);

        $msg =  'Your Purchase Processed Successfully';
        send_email($user->email, $user->firstname, 'Purchase Processed', $msg);
        $sms =  'Your Purchase Processed Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Deposit Request Approved Successfully!');
    }

    public function destroy(Deposit $deposit)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $user = User::find($deposit['user_id']);

        $msg =  'Your Purchase Request canceled by Admin';
        send_email($user->email, $user->firstname, 'Purchase Canceled', $msg);
        $sms =  'Your Purchase Request canceled by Admin';
        send_sms($user->mobile, $sms);

        $deposit->delete();

        return back()->with('success', 'Deposit Canceled Successfully!');
    }
}
