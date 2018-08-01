<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uwdlog;
use App\User;
use App\Deposit;
use App\Uaccount;

class UwdlogController extends Controller
{
	public function userlog()
    {
    	$userlogs = Uwdlog::orderBy('id', 'desc')->paginate(10);
    	return view('admin.userlog.userlog', compact('userlogs'));
    }

    public function users()
    {
    	$users = User::orderBy('id', 'desc')->paginate(10);
    	return view('admin.userlog.users', compact('users'));
    }

    public function newusers()
    {
    	$users = User::where('status', '0')->orderBy('id', 'desc')->paginate(10);
    	return view('admin.userlog.newusers', compact('users'));
    }
     public function single($id)
    {
    	$user = User::findorFail($id);
        $deposits = Deposit::where('user_id', $user['id'] )->sum('amount');
    	return view('admin.userlog.single', compact('user','trans', 'deposits'));
    }

    public function blupdate(Request $request,$id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$user = User::find($id);

    	 $this->validate($request,
            [
                'amount' => 'required',
            ]);

        if($request->amount <= 0)
        {
            return back()->with('alert','Amount Should be Positive Number');
            exit();
        }

         $ucode = Uaccount::where('user_id',$user->id)->first();

        if ($ucode == null)
        {
            $uac['user_id'] = $user->id;
            $uac['accnum'] = str_random(32);
            $new_account = Uaccount::create($uac);
            $ucode = Uaccount::where('user_id',$user->id)->first();
        }

        if($request->curn == '1')
        {
            $opt = $request->status =="1" ?1:0 ;

             if($opt == '1')
             {
                $user['balance'] = $user['balance'] + $request->amount;
             }
             else
             {
                $user['balance'] = $user['balance'] - $request->amount;
             }

            $user->save();

              $ulog['user_id'] = $user->id;
                $ulog['trxid'] = str_random(40);
                $ulog['toacc'] = $ucode->accnum;
                $ulog['charge'] = '0';
                $ulog['amount'] = $request->amount;
                $ulog['flag'] = 1;
                $ulog['status'] = 1;
                $ulog['balance'] = $user['balance'];
                $ulog['desc'] = $request->message;

                Uwdlog::create($ulog); 
        }
        else
        {
            $opt = $request->status =="1" ?1:0 ;

             if($opt == '1')
             {
                $user['bitcoin'] = $user['bitcoin'] + $request->amount;
             }
             else
             {
                $user['bitcoin'] = $user['bitcoin'] - $request->amount;
             }

            $user->save(); 

              $ulog['user_id'] = $user->id;
                $ulog['trxid'] = str_random(40);
                $ulog['toacc'] = $ucode->accnum;
                $ulog['charge'] = '0';
                $ulog['amount'] = $request->amount;
                $ulog['flag'] = 0;
                $ulog['status'] = 1;
                $ulog['balance'] = $user['bitcoin'];
                $ulog['desc'] = $request->message;

                Uwdlog::create($ulog);
        }


        $msg =  $request->message;
        send_email($user->email, $user->firstname, 'Balance Added', $msg);
        $sms =  $request->message;
        send_sms($user->mobile, $sms);

    	return back()->withSuccess('Balance Added Successfuly');
    }

    public function statupdate(Request $request,$id)
    { return back()->with('alert', 'Demo Version. Can Not Change');
    	$user = User::find($id);

        $this->validate($request,
            [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            ]);

        $user['firstname'] = $request->firstname ;
        $user['lastname'] = $request->lastname ;
        $user['address'] = $request->address ;
        $user['city'] = $request->city ;
        $user['postcode'] = $request->postcode ;
        $user['country'] = $request->country ;
        $user['mobile'] = $request->mobile;
        $user['status'] = $request->status =="1" ?1:0;
        $user['docv'] = $request->docv =="1" ?1:0;
        $user['emailv'] = $request->emailv =="1" ?1:0;
        $user['smsv'] = $request->smsv =="1" ?1:0;
        $user['gtfa'] = $request->gtfa =="1" ?1:0;

        $user->save();

        $msg =  'Your Profile Updated by Admin';
        send_email($user->email, $user->firstname, 'Balance Added', $msg);
        $sms =  'Your Profile Updated by Admin';
        send_sms($user->mobile, $sms);

    	return back()->withSuccess('User Profile Updated Successfuly');
    }


    public function email($id)
    {
        $user = User::findorFail($id);
        return view('admin.userlog.email',compact('user'));
    }

    public function broadcast()
    {
        return view('admin.userlog.broadcast');
    }

    public function sendemail(Request $request)
    { return back()->with('alert', 'Demo Version. Can Not Change');
         $this->validate($request,
            [
                'emailto' => 'required|email',
                'reciver' => 'required',
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);
         $to = $request->emailto;
         $name = $request->reciver;
         $subject = $request->subject;
         $message = $request->emailMessage;

         send_email($to, $name, $subject, $message);

        return back()->withSuccess('Mail Sent Successfuly');

    }

    public function broadcastemail(Request $request)
    { return back()->with('alert', 'Demo Version. Can Not Change');
        $this->validate($request,
            [
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);

        $users = User::where('status', '1')->get();

        foreach ($users as $user)
        {

         $to = $user->email;
         $name = $user->firstname;
         $subject = $request->subject;
         $message = $request->emailMessage;

         send_email($to, $name, $subject, $message);
        }

        return back()->withSuccess('Mail Sent Successfuly');
    }

}
