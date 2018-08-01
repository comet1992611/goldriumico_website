<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Gateway;
use App\Price;
use App\Deposit;
use App\Uwdlog;
use App\Gsetting;
use Session;
use App\Lib\coinPayments;


class PaymentController extends Controller
{
	
	public function depconfirm(Request $request)
	{
		$this->validate($request,
			[
				'amount' => 'required',
			]);

		if ($request->amount <= 0) 
		{
			return redirect()->route('deposit')->with('alert', 'Invalid Amount');
		}
		else
		{
			$all = file_get_contents("https://blockchain.info/ticker");
			$res = json_decode($all);
			$btcRate = $res->USD->last;
			$cprice = Price::latest()->first();

			$method = Gateway::find(5);

			$amon = $request->amount;
			$bcoin = ($amon*$cprice->price)/$btcRate;


// You need to set a callback URL if you want the IPN to work
			$callbackUrl = route('ipn.coinPay');

// Create an instance of the class
			$CP = new coinPayments();

// Set the merchant ID and secret key (can be found in account settings on CoinPayments.net)
			$CP->setMerchantId($method->val1);
			$CP->setSecretKey($method->val2);

// Create a payment button with item name, currency, cost, custom variable, and the callback URL

			$ntrc = str_random(16);

			$deposit['user_id'] = Auth::user()->id;
			$deposit['amount'] = $amon;
			$deposit['inusd'] = $bcoin;
			$deposit['charge'] = "0";
			$deposit['gateway_id'] = 5;
			$deposit['trxid'] = $ntrc;
			$deposit['status'] = 0;
			Deposit::create($deposit);


			$form = $CP->createPayment('Purchase nCoin', 'btc',  $bcoin, $ntrc, $callbackUrl);


			return view('front.user.depoconf', compact('bcoin','amon','form'));
		} 

	}

	public function ipncoin(Request $request)
	{
		$track = $request->custom;
		$status = $request->status;
		$amount1 = floatval($request->amount1);
		$currency1 = $request->currency1;

		$DepositData = Deposit::where('trxid', $track)->first();


		if ($currency1 == "btc" && $amount1 >= $DepositData->inusd && $DepositData->status == '0') 
		{

			if ($status>=100 || $status==2) {

				$user = User::find($DepositData['user_id']);
				$user['balance'] =  $user['balance'] + $DepositData['amount'];
				$user->save(); 

				$ucode = Uaccount::where('user_id',$user->id)->first();

		        if ($ucode == null)
		        {
		            $uac['user_id'] = Auth::id();
		            $uac['accnum'] = str_random(32);
		            $new_account = Uaccount::create($uac);
		           $ucode = Uaccount::where('user_id',$user->id)->first();
		        }

				$ulog['user_id'] = $DepositData['user_id'];
				$ulog['trxid'] = $DepositData['trxid'];
				$ulog['amount'] = $DepositData['amount'];
				$ulog['charge'] = '0';
				$ulog['toacc'] = $ucode->accnum;
				$ulog['flag'] = 1;
				$ulog['status'] = 1;
				$ulog['balance'] = $user['balance'];
				$ulog['desc'] = "Purchased by BitCoin";
				Uwdlog::create($ulog);

				$DepositData['status'] = 1;
				$DepositData->save();

			}

		}

	}

}	
