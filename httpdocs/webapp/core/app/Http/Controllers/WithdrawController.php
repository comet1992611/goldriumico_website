<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Withdraw;
use App\Wdmethod;
use App\User;
use App\Uwdlog;

class WithdrawController extends Controller
{

    public function index()
    {
    	$withd = Withdraw::where('status', 0)->orderBy('id', 'desc')->get();
    	return view('admin.withdraw.requests', compact('withd'));
    }

     public function approve(Request $request, $id)
    {
        $withdraw = Withdraw::findorFail($id);

        $withdraw['status'] = 1;

        $withdraw->save();

        $user = User::find($withdraw['user_id']);

        $msg =  'Your Withdraw Request Approved by Admin';
        send_email($user->email, $user->firstname, 'Withdraw Approval', $msg);
        $sms =  'Your Withdraw Approved by Admin';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Withdraw Request Approved Successfully!');
    }


     public function lists()
    {
    	$withd = Withdraw::where('status', 1)->orderBy('id', 'desc')->get();
    	return view('admin.withdraw.withlists', compact('withd'));
    }

     public function refund(Request $request, $id)
    {
        $withdraw = Withdraw::find($id);

        $user = User::find($withdraw['user_id']);
        $balance = $user->bitcoin + $withdraw['amount'];

        $user['bitcoin'] = $balance;

        $user->save();

        $ulog['user_id'] = $withdraw->user_id;
        $ulog['trxid'] = $withdraw->wdid;
        $ulog['amount'] = $withdraw->amount;
        $ulog['flag'] = 0;
        $ulog['status'] = 1;
        $ulog['balance'] = $user['balance'];
        $ulog['desc'] = 'Failed to Send BitCoin';

        Uwdlog::create($ulog);

        $withdraw->delete();

        $msg =  'Your Withdraw Refunded by Admin';
        send_email($user->email, $user->firstname, 'Withdraw Refund', $msg);
        $sms =  'Your Withdraw Refunded by Admin';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Withdraw Amount Refunded Successfully!');
    }

      public function refundlog()
    {
        $refund = Withdraw::where('status', 2)->orderBy('id', 'desc')->get();
        return view('admin.withdraw.refunded', compact('refund'));
    }

}
