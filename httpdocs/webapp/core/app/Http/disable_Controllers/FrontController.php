<?php

namespace App\Http\Controllers;

use App\About;
use App\Charge;
use App\Contac;
use App\Gsetting;
use App\Lib\GoogleAuthenticator;
use App\Menu;
use App\Payintro;
use App\Paymethod;
use App\Price;
use App\Sericon;
use App\Service;
use App\Slider;
use App\Statistic;
use App\Testimonial;
use App\Timeline;
use App\User;
use App\Uwdlog;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller
{
    public function index()
    {
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();
        $allprice = Price::orderBy('id', 'ASC')->get();
        $sup = Charge::first();
        $supply = $sup->supply/1000000;
        $user = User::sum('balance');
        $mval = ($sup->supply-$user)/1000000;

        $banner = Slider::first();
        $about = About::first();
        $items = Testimonial::all();
        $times = Timeline::all();
        $service = Service::pluck('heading')->first();

    	return view('front.index', compact('banner','times','allprice','currentRate','price','supply','mval','about','items','service'));
    }

    public function page($id)
    {
    	$single = Menu::findorFail($id);
        $page = $single->name;
    	return view('front.single', compact('single','page'));
    }

    public function contact()
    {
        return view('front.contact');
    }

     public function conmail(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',

        ]);

        $name = $request->name;
        $email = $request->email;
        $msg = $request->comment;
        send_email($email, $name, 'Visitor Messeage', $msg);

        return back()->with('success', 'Your Message sent succesfully');
    }

    public function register($reference)
    {
        return view('auth.register',compact('reference'));
    }


     public function forgotPass(Request $request)
        {
            $this->validate($request,
                [
                    'email' => 'required',
                ]);
            $user = User::where('email', $request->email)->first();

            if ($user == null) 
            {
                return back()->with('alert', 'Email Not Available');
            }
            else
            {
                $to =$user->email;
                $name = $user->name;
                $subject = 'Password Reset';
                $code = str_random(30);
                $message = 'Use This Link to Reset Password: '.url('/').'/reset/'.$code;

                DB::table('password_resets')->insert(
                    ['email' => $to, 'token' => $code, 'created_at' => date("Y-m-d h:i:s")]
                );

                send_email($to, $name, $subject, $message);

                return back()->with('success', 'Password Reset Email Sent Succesfully');
            }

        }

        public function resetLink($code)
        {
            $reset = DB::table('password_resets')->where('token', $code)->orderBy('created_at', 'desc')->first();
            if (is_null($reset))
            {
                return redirect()->route('login')->with('alert', 'Invalid Reset Link');
            }
            else
            {
                if( $reset->status == 1) 
                {
                    return redirect()->route('login')->with('alert', 'Invalid Reset Link');
                }
                else
                {
                    return view('auth.passwords.reset', compact('reset'));
                }
            }
        }

        public function passwordReset(Request $request)
        {
            $this->validate($request,
                [
                    'email' => 'required',
                    'token' => 'required',
                    'password' => 'required',
                    'password_confirmation' => 'required',
                ]);

            $reset = DB::table('password_resets')->where('token', $request->token)->orderBy('created_at', 'desc')->first();
            $user = User::where('email', $reset->email)->first();
            if ( $reset->status == 1) 
            {
                return redirect()->route('login')->with('alert', 'Invalid Reset Link');
            }
            else
            {
                if($request->password == $request->password_confirmation)
                {
                    $user->password = bcrypt($request->password);
                    $user->save();

                    DB::table('password_resets')->where('email', $user->email)->update(['status' => 1]);

                    $msg =  'Password Changed Successfully';
                    send_email($user->email, $user->username, 'Password Changed', $msg);
                    $sms =  'Password Changed Successfully';
                    send_sms($user->mobile, $sms);

                    return redirect()->route('login')->with('success', 'Password Changed');
                }
                else 
                {
                    return back()->with('alert', 'Password Not Matched');
                }
            }
        }

    public function unauthorized()
    {
        if(Auth::user()->tfav == '1' && Auth::user()->status == '1' && Auth::user()->emailv == 1 && Auth::user()->smsv == 1)
        {
            return redirect('home');
        }
        else
        {
          return view('auth.notauthor');
        }

    }

    public function sendemailver()
    {
        $user = User::find(Auth::id());
        $chktm = $user->vsent+1000;
        if ($chktm >time())
         {
            $delay = $chktm-time();
           return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $code = str_random(8);
            $msg = 'Your Verification code is: '.$code;
            $user['vercode'] = $code ;
            $user['vsent'] = time();
            $user->save();
            send_email($user->email, $user->username, 'Verification Code', $msg);
            return back()->with('success', 'Email verification code sent succesfully');
        }

    }
     public function sendsmsver()
    {
        $user = User::find(Auth::id());
        $chktm = $user->vsent+1000;
        if ($chktm >time())
         {
            $delay = $chktm-time();
           return back()->with('alert', 'Please Try after '.$delay.' Seconds');
        }
        else
        {
            $code = str_random(8);
            $sms =  'Your Verification code is: '.$code;
            $user['vercode'] = $code;
            $user['vsent'] = time();
            $user->save();

            send_sms($user->mobile, $sms);
            return back()->with('success', 'SMS verification code sent succesfully');
        }


    }

    public function emailverify(Request $request)
    {

        $this->validate($request, [
            'code' => 'required'
        ]);
        $user = User::find(Auth::id());

        $code = $request->code;
        if ($user->vercode == $code)
        {
           $user['emailv'] = 1;
           $user['vercode'] = str_random(10);
           $user['vsent'] = 0;
           $user->save();

            return redirect('home')->with('success', 'Email Verified');
        }
        else
        {
             return back()->with('alert', 'Wrong Verification Code');
        }

    }

     public function smsverify(Request $request)
    {

        $this->validate($request, [
            'code' => 'required'
        ]);
        $user = User::find(Auth::id());

        $code = $request->code;
        if ($user->vercode == $code)
        {
           $user['smsv'] = 1;
           $user['vercode'] = str_random(10);
           $user['vsent'] = 0;
           $user->save();

            return redirect('home')->with('success', 'SMS Verified');
        }
        else
        {
             return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function verify2fa( Request $request)
    {
        $user = User::find(Auth::id());

        $this->validate($request,
            [
                'code' => 'required',
            ]);
        $ga = new GoogleAuthenticator();

        $secret = $user->secretcode;
        $oneCode = $ga->getCode($secret); 
        $userCode = $request->code;

        if ($oneCode == $userCode) { 
            $user['tfav'] = 1;

            $user->save();
            return redirect('home');
        } else {
            
            return back()->with('alert', 'Wrong Verification Code');
        }

    }

    public function search(Request $request)
    {
         $this->validate($request, [
            'search' => 'required'
        ]);

         if(strlen($request->search) == 32)
         {
            $logs = Uwdlog::where('toacc', $request->search)->where('flag', '1')->get();
            if ($logs == null) 
            {
                return back()->with('alert', 'Nothing Found');
            }
            else
            {
               return view('front.result', compact('logs')); 
            }
            
         }
         elseif(strlen($request->search) == 40)
         {
           $logs = Uwdlog::where('trxid', $request->search)->get();
            if ($logs == null) 
            {
                return back()->with('alert', 'Nothing Found');
            }
            else
            {
               return view('front.result', compact('logs')); 
            }
         }
         else
         {
            return back()->with('alert', 'Nothing Found');
         }

       
    }

    public function cron()
    {
        $user = User::sum('balance');
        $charge = Charge::first();
        $tm = time()-7*24*3600;
// for ($i=0; $i < 800 ; $i++) {
// $tm = $tm+900;
        $base = $charge->basep;
        $var = $charge->varp;
        $now = $base+(($var*$user)/100);
        $add = rand(1,100)/100;
        $rate = $now+$add;
        $final = number_format(floatval($rate) , 2, '.', '');

        $price['price'] = $final;
        $price['created_at'] = date("Y-m-d H:i:s", $tm);
        Price::create($price);
// 2017-11-09 10:45:51

        // echo $price['created_at'];
// }
    }
}
