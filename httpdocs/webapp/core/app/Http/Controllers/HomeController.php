<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use Auth;
use App\User;
use App\Uwdlog;
use App\Withdraw;
use App\Wdmethod;
use App\Gateway;
use App\Gsetting;
use App\Deposit;
use App\Charge;
use Carbon\Carbon;
use App\Reference;
use App\Upgrade;
use App\Avatar;
use App\Docver;
use App\Price;
use Session;
use Hash;
use App\Lib\GoogleAuthenticator;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ckstatus');
    }

    public function index()
    {

        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;

        $allprice = Price::orderBy('id', 'ASC')->get();

        return view('home',compact('currentRate','price','totusd','btusd','nusd','allprice'));
    }

    public function convert()
    {
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;

        return view('front.user.convert',compact('currentRate','price', 'btusd', 'nusd', 'totusd'));
    }

    public function transactions()
    {
        $trans = Uwdlog::where('user_id', Auth::user()->id )->orderBy('id', 'desc')->paginate(10);
        return view('front.user.trans',compact('trans'));
    }

    public function bittrans()
    {
        $trans = Uwdlog::where('user_id', Auth::user()->id )->where('flag','0')->orderBy('id', 'desc')->paginate(10);
        return view('front.user.bitlog',compact('trans'));
    }

    public function cointrans()
    {
        $trans = Uwdlog::where('user_id', Auth::user()->id )->where('flag','1')->orderBy('id', 'desc')->paginate(10);
        return view('front.user.coinlog',compact('trans'));
    }

    public function userprofile()
    {
        $user = User::find(Auth::id());
        $avatar = Avatar::where('user_id', $user['id'] )->pluck('photo')->first();
        return view('front.user.profile', compact('user', 'avatar'));
    }

    public function cngavatar(Request $request)
    {
        $avatar = Avatar::where('user_id', Auth::id() )->first();

        if($avatar == null)
        {
            $this->validate($request, [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000'
                        ]);

            if($request->hasFile('photo'))
                {
                    $newava['photo'] = Auth::id().'.png';
                    $request->photo->move('assets/images/avatar',$newava['photo']);
                }
            $newava['user_id'] = Auth::id();

            Avatar::create($newava);
            return back()->withSuccess('Your Photo Updated Successfuly!');
        }
        else
        {
            $this->validate($request, [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

            if($request->hasFile('photo'))
                {
                    $avatar['photo'] = Auth::id().'.png';
                    $request->photo->move('assets/images/avatar',$avatar['photo']);
                }

            $avatar->save();

            return back()->withSuccess('Your Photo Updated Successfuly');

        }
    }

    public function userupdate(Request $request)
    {
        $user = User::find(Auth::id());

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

        $user->save();

        $msg =  'User Information Updated';
        send_email($user->email, $user->username, 'Info Updated', $msg);
        $sms =  'User Information Updated';
        send_sms($user->mobile, $sms);

        return back()->withSuccess('Profile Information Updated Successfuly');

    }

    //Documnet Verify
    public function document()
    {
      return view('front.user.document');  
    }

    public function doc_verify(Request $request)
    {        
        $this->validate($request, 
            [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
            ]);

        $docm['user_id'] = Auth::id();
        $docm['name'] = $request->name;
        $docm['details'] = $request->details;
        if($request->hasFile('photo'))
            {
                $docm['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move('assets/images/document',$docm['photo']);
            }

        Docver::create($docm);

        return back()->withSuccess('Verification Request Sent Successfuly!'); 

    }

    //Change password
    public function changepass()
    {
        $user = User::find(Auth::id());
        $avatar = Avatar::where('user_id', $user['id'] )->pluck('photo')->first();
        return view('auth.chpass', compact('user','avatar'));
    }

    public function chnpass()
    {
      $user = User::find(Auth::user()->id);

      if(Hash::check(Input::get('passwordold'), $user['password']) && Input::get('password') == Input::get('password_confirmation'))
      {
        $user->password = bcrypt(Input::get('password'));
        $user->save();

        $msg =  'Password Changed Successfully';
        send_email($user->email, $user->username, 'Password Changed', $msg);
        $sms =  'Password Changed Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Password Changed');
      }
      else 
      {
          return back()->with('alert', 'Password Not Changed');
      }
    }


public function deposit()
    {
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;
        return view('front.user.deposit', compact('btusd','nusd','totusd'));
    }

    public function refered()
    {
        $user = User::find(Auth::User()->id);
        $refers = User::where('refid', $user['id'] )->orderBy('id', 'desc')->get();
        $today = Reference::where('refer', $user['username'] )->whereDate('created_at', Carbon::today()->toDateString())->get();
        return view('front.user.refered', compact('refers','today'));
    }

    public function google2fa()
    {
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl(Auth::user()->email, $secret);

        $prevcode = Auth::user()->secretcode;
        $prevqr = $ga->getQRCodeGoogleUrl(Auth::user()->email, $prevcode);

        return view('front.user.goauth.create', compact('secret','qrCodeUrl','prevcode','prevqr'));

    }

    public function create2fa(Request $request)
    {
        $user = User::find(Auth::id());
        
        $this->validate($request,
            [
                'key' => 'required',
            ]);

        $user['secretcode'] = $request->key;
        $user['gtfa'] = 1;
        $user['tfav'] = 1;
        $user->save();

        $msg =  'Google Two Factor Authentication Enabled Successfully';
        send_email($user->email, $user->username, 'Google 2FA', $msg);
        $sms =  'Google Two Factor Authentication Enabled Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Google Authenticator Enabeled Successfully');
    }

    public function disable2fa()
    {
        $user = User::find(Auth::id());
        $user['gtfa'] = 0;
        $user['tfav'] = 1;
        $user['secretcode'] = '0';
        $user->save();

        $msg =  'Google Two Factor Authentication Disabled Successfully';
        send_email($user->email, $user->username, 'Google 2FA', $msg);
        $sms =  'Google Two Factor Authentication Disabled Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Two Factor Authenticator Disable Successfully');
    }



}
