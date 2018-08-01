<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Gateway;
use App\General;
use App\Sell;
use App\Ico;
use Session;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Lib\coinPayments;
use CoinGate\CoinGate;
use App\Lib\BlockIo;

class PaymentController extends Controller
{

	public function buyConfirm()
	{
		$gset = General::first();

		$track = Session::get('Track');
		$data = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();
		$ico = Ico::find($data->ico_id);
		if($data->status!=0)
		{
			return redirect()->route('home')->with('alert', 'An Error Occurd!');;
			exit();
		}
		$gatewayData = Gateway::where('id', $data->gateway_id)->first();

		if ($data->gateway_id==1) 
		{
			$amount = $ico->price*$data->amount;

			$paypal['amount'] = $amount;
			$paypal['sendto'] = $gatewayData->val1;
			$paypal['track'] = $track;

			return view('user.payment.paypal', compact('paypal'));

		}
		elseif ($data->gateway_id==2) 
		{
			$amount = $ico->price*$data->amount;

			$perfect['amount'] = $amount;
			$perfect['value1'] = $gatewayData->val1;
			$perfect['value2'] = $gatewayData->val2;
			$perfect['track'] = $track;
			return view('user.payment.perfect', compact('perfect'));
		}
		elseif ($data->gateway_id==3) 
		{

			$all = file_get_contents("https://blockchain.info/ticker");
			$res = json_decode($all);
			$btcrate = $res->USD->last;

			$amount = intval($data->amount);
			$usd = $ico->price*$amount;
			$btcamount = $usd/$btcrate;
			$btc = round($btcamount, 8);

			$DepositData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();

			if($DepositData->bcam == 0){
				$blockchain_root = "https://blockchain.info/";
				$blockchain_receive_root = "https://api.blockchain.info/";
				$mysite_root = url('/');
				$secret = "ABIR";
				$my_xpub = $gatewayData->val2;
				$my_api_key = $gatewayData->val1;

				$invoice_id = $track;
				$callback_url = $mysite_root . "/ipnbtc?invoice_id=" . $invoice_id . "&secret=" . $secret;


				$resp = @file_get_contents($blockchain_receive_root . "v2/receive?key=" . $my_api_key . "&callback=" . urlencode($callback_url) . "&xpub=" . $my_xpub);

				if (!$resp) {

//BITCOIN API HAVING ISSUE. PLEASE TRY LATER
					return redirect()->route('home')->with('alert', 'BLOCKCHAIN API HAVING ISSUE. PLEASE TRY LATER');
					exit;
				}

				$response = json_decode($resp);
				$sendto = $response->address;

// $sendto = "1HoPiJqnHoqwM8NthJu86hhADR5oWN8qG7";

				$data['bcid'] = $sendto;
				$data['bcam'] = $btc;
				$data->save();

			}
			$DepositData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();
/////UPDATE THE SEND TO ID

			$bitcoin['amount'] = $DepositData->bcam;
			$bitcoin['sendto'] = $DepositData->bcid;

			$var = "bitcoin:$DepositData->bcid?amount=$DepositData->bcam";
			$bitcoin['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";

			return view('user.payment.bitcoin', compact('bitcoin'));
		}
		elseif($data->gateway_id == 4)
		{
			return view('user.payment.stripe');
		}
		elseif($data->gateway_id == 5)
		{
			$ipn = route('ipn.skrill');
			$img = asset('assets/images/logo/logo.png');

			$gateway = Gateway::find(5);
			$gnl = General::first();
			$amount = intval($data->amount);
			$usd = $ico->price*$amount;

			$sdata['send_pay_request'] =  '<form action="https://www.moneybookers.com/app/payment.pl" method="post" id="pament_form">

			<input name="pay_to_email" value="'.$gateway->val1.'" type="hidden">

			<input name="transaction_id" value="'.$data->trx.'" type="hidden">

			<input name="return_url" value="'.route('home').'" type="hidden">

			<input name="return_url_text" value="Return '.$gnl->title.'" type="hidden">

			<input name="cancel_url" value="'.route('home').'" type="hidden">

			<input name="status_url" value="'.$ipn.'" type="hidden">

			<input name="language" value="EN" type="hidden">

			<input name="amount" value="'.$usd.'" type="hidden">

			<input name="currency" value="USD" type="hidden">

			<input name="detail1_description" value="'.$gnl->title.'" type="hidden">

			<input name="detail1_text" value="Add Fund To '.$gnl->title.'" type="hidden">

			<input name="logo_url" value="'.$img.'" type="hidden">

			</form>';

			return view('user.payment.skrill',$sdata);
		}
		elseif($data->gateway_id == 6)
		{
			return redirect()->route('coinGate');
		}
//Manual Payments
		elseif($data->gateway_id == 7)
		{
			$all = file_get_contents("https://blockchain.info/ticker");
			$res = json_decode($all);
			$btcRate = $res->USD->last;
			$amon = $data->amount;
			$amount = $ico->price*$data->amount;
			$bcoin = round($amount/$btcRate,8);
			$method = Gateway::find(7);

// You need to set a callback URL if you want the IPN to work
			$callbackUrl = route('ipn.coinPay');

// Create an instance of the class
			$CP = new coinPayments();

// Set the merchant ID and secret key (can be found in account settings on CoinPayments.net)
			$CP->setMerchantId($method->val1);
			$CP->setSecretKey($method->val2);

// Create a payment button with item name, currency, cost, custom variable, and the callback URL

			$ntrc = $data->trx;

			$form = $CP->createPayment('Purchase Coin', 'btc',  $bcoin, $ntrc, $callbackUrl);

			return view('user.payment.coinpay', compact('bcoin','amon','form'));
		}
		elseif($data->gateway_id ==8)
		{
			$all = file_get_contents("https://blockchain.info/ticker");
			$res = json_decode($all);
			$btcRate = $res->USD->last;
			$amon = $data->amount;
			$amount = $ico->price*$data->amount;
			$bcoin = round($amount/$btcRate,8);
			$method = Gateway::find(8);

			$DepositData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();

			if($DepositData->bcam == 0){

				$apiKey = $method->val1;
$version = 2; // API version
$pin =  $method->val2;
$block_io = new BlockIo($apiKey, $pin, $version);
$ad = $block_io->get_new_address();


if ($ad->status == 'success') 
{ 
	$data = $ad->data;
	$sendadd = $data->address;

	$DepositData['bcid'] = $sendadd;
	$DepositData['bcam'] = $bcoin;
	$DepositData->save();
}
else
{
	return back()->with('alert', 'Failed to Process');
}
}

$DepositData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();

$sendadd = $DepositData->bcid;
$bcoin = $DepositData->bcam;


$varb = "bitcoin:".$DepositData->bcid ."?amount=".$DepositData->bcam;
$qrurl =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8\" title='' style='width:300px;' />";

return view('user.payment.blockio', compact('bcoin','amon','sendadd','qrurl'));
}


}

public function ipnpaypal()
{

	$raw_post_data = file_get_contents('php://input');
	$raw_post_array = explode('&', $raw_post_data);
	$myPost = array();
	foreach ($raw_post_array as $keyval) 
	{
		$keyval = explode ('=', $keyval);
		if (count($keyval) == 2)
			$myPost[$keyval[0]] = urldecode($keyval[1]);
	}


	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')) 
	{
		$get_magic_quotes_exists = true;
	}
	foreach ($myPost as $key => $value) 
	{
		if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
			$value = urlencode(stripslashes($value));
		} else {
			$value = urlencode($value);
		}
		$req .= "&$key=$value";
	}


// $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	$paypalURL = "https://secure.paypal.com/cgi-bin/webscr";
	$ch = curl_init($paypalURL);
	if ($ch == FALSE) 
	{
		return FALSE;
	}
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
	$res = curl_exec($ch);
	$tokens = explode("\r\n\r\n", trim($res));
	$res = trim(end($tokens));

	if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) 
	{


		$receiver_email  = $_POST['receiver_email'];
		$mc_currency  = $_POST['mc_currency'];
		$mc_gross  = $_POST['mc_gross'];
		$track = $_POST['custom'];

		$sellData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();
		$gatewayData = Gateway::find(1);

		$ico = Ico::find($sellData->ico_id);
		$amount = $ico->price*$sellData->amount;

		if($receiver_email==$gatewayData->val1 && $mc_currency=="USD" && $mc_gross ==$amount && $sellData->status=='0')
		{

			$ico['sold'] = intval($ico['sold']  + $sellData->amount);
			if($ico['sold'] >= $ico['quant'])
			{
				$ico['status'] = 2;
			}
			$ico->save();

			$user = User::find($sellData['user_id']);
			$user['balance'] = $user['balance'] + $sellData->amount;
			$user->save();

			if($user->refer!=0) 
			{
				$gnl = General::first();
				$commision = ($sellData->amount*$gnl->refcom)/100;

				$refer = User::find($user->refer);
				$refer['balance'] = $refer->balance + $commision;
				$refer->save();
			} 

			$sellData['status'] = 1;
			$sellData->save();

			return redirect()->route('home')->with('success', 'Bought Successfully!');

		}
	}

}

public function ipnperfect()
{

	$gatewayData = Gateway::find(2);

	$passphrase=strtoupper(md5($gatewayData->val2));


	define('ALTERNATE_PHRASE_HASH',  $passphrase);
	define('PATH_TO_LOG',  '/somewhere/out/of/document_root/');
	$string=
	$_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
	$_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
	$_POST['PAYMENT_BATCH_NUM'].':'.
	$_POST['PAYER_ACCOUNT'].':'.ALTERNATE_PHRASE_HASH.':'.
	$_POST['TIMESTAMPGMT'];

	$hash=strtoupper(md5($string));
	$hash2 = $_POST['V2_HASH'];

	if($hash==$hash2){

		$amo = $_POST['PAYMENT_AMOUNT'];
		$unit = $_POST['PAYMENT_UNITS'];
		$track = $_POST['PAYMENT_ID'];

		$sellData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();
		$ico = Ico::find($sellData->ico_id);
		$amount = $ico->price*$sellData->amount;

		if($_POST['PAYEE_ACCOUNT']==$gatewayData->val1 && $unit=="USD" && $amo ==$amount && $sellData->status=='0'){

			$ico['sold'] = intval($ico['sold'] + $sellData->amount);
			if($ico['sold'] >= $ico['quant'])
			{
				$ico['status'] = 2;
			}
			$ico->save();

			$user = User::find($sellData['user_id']);
			$user['balance'] =  $user['balance'] + $sellData['amount'];
			$user->save(); 

			if($user->refer!=0) 
			{
				$gnl = General::first();
				$commision = ($sellData['amount']*$gnl->refcom)/100;

				$refer = User::find($user->refer);
				$refer['balance'] = $refer->balance + $commision;
				$refer->save();
			} 

			$sellData['status'] = 1;
			$sellData->save();

			return redirect()->route('home')->with('success', 'Deposit Successfull!');

		}
	}

}

public function ipnbtc(){

	$gatewayData = Gateway::find(3);

	$track = $_GET['invoice_id'];
	$secret = $_GET['secret'];
	$address = $_GET['address'];
	$value = $_GET['value'];
	$confirmations = $_GET['confirmations'];
	$value_in_btc = $_GET['value'] / 100000000;

	$trx_hash = $_GET['transaction_hash'];

	$DepositData = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();


	if ($DepositData->status==0) {

		if ($DepositData->bcam==$value_in_btc && $DepositData->bcid==$address && $secret=="ABIR" && $confirmations>2){

			$DepositData['status'] = 1;

			$user = User::find($DepositData['user_id']);
			$user['balance'] =  $user['balance'] + $DepositData['amount'];
			$user->save(); 

			$ico = Ico::find($DepositData->ico_id);
			$ico['sold'] = intval($ico['sold'] + $DepositData->amount);
			if($ico['sold'] >= $ico['quant'])
			{
				$ico['status'] = 2;
			}
			$ico->save();

			if($user->refer!=0) 
			{
				$gnl = General::first();
				$commision = ($DepositData->amount*$gnl->refcom)/100;

				$refer = User::find($user->refer);
				$refer['balance'] = $refer->balance + $commision;
				$refer->save();
			} 

			$DepositData->save();

			return redirect()->route('home')->with('success', 'Deposit Successfull!');

		}

	}

}

public function ipnstripe(Request $request)
{
	$track =   Session::get('Track');
	$data = Sell::where('trx',$track)->orderBy('id', 'DESC')->first();

	$this->validate($request,
		[
			'cardNumber' => 'required',
			'cardExpiry' => 'required',
			'cardCVC' => 'required',
		]);

	$cc = $request->cardNumber;
	$exp = $request->cardExpiry;
	$cvc = $request->cardCVC;

	$exp = $pieces = explode("/", $_POST['cardExpiry']);
	$emo = trim($exp[0]);
	$eyr = trim($exp[1]);
	$cnts = $data->amount*100;

	$gatewayData = Gateway::find(4);

	Stripe::setApiKey($gatewayData->val1);

	try{
		$token = Token::create(array(
			"card" => array(
				"number" => "$cc",
				"exp_month" => $emo,
				"exp_year" => $eyr,
				"cvc" => "$cvc"
			)
		));

		try{
			$charge = Charge::create(array(
				'card' => $token['id'],
				'currency' => 'USD',
				'amount' => $cnts,
				'description' => 'item',
			));


			if ($charge['status'] == 'succeeded') {

				$ico = Ico::find($data->ico_id);
				$ico['sold'] = intval($ico['sold'] + $data->amount);
				if($ico['sold'] >= $ico['quant'])
				{
					$ico['status'] = 2;
				}
				$ico->save();

				$user = User::find($data['user_id']);
				$user['balance'] =  $user['balance'] + $data['amount'];
				$user->save(); 

				if($user->refer!=0) 
				{
					$gnl = General::first();
					$commision = ($data['amount']*$gnl->refcom)/100;

					$refer = User::find($user->refer);
					$refer['balance'] = $refer->balance + $commision;
					$refer->save();
				} 

				$data['status'] = 1;
				$data->save();

				return redirect()->route('home')->with('success', 'Bought Successfully!');

			}

		}
		catch (Exception $e){
			return redirect()->route('home')->with('alert', $e->getMessage());
		}

	}catch (Exception $e){
		return redirect()->route('home')->with('alert', $e->getMessage());
	}

}

public function ipncoin(Request $request)
{
	$track = $request->custom;
	$status = $request->status;
	$amount1 = floatval($request->amount1);
	$currency1 = $request->currency1;

	$DepositData = Sell::where('trx', $track)->first();
	$ico = Ico::find($DepositData->ico_id);
	$all = file_get_contents("https://blockchain.info/ticker");
	$res = json_decode($all);
	$btcRate = $res->USD->last;
	$amount = $ico->price*$DepositData->amount;
	$bcoin = round($amount/$btcRate,8);

	if ($currency1 == "btc" && $amount1 >= $bcoin && $DepositData->status == '0') 
	{
		if ($status>=100 || $status==2) 
		{
			$user = User::find($DepositData['user_id']);
			$user['balance'] =  $user['balance'] + $DepositData['amount'];
			$user->save(); 

			$ico['sold'] = intval($ico['sold'] + $DepositData->amount);
			if($ico['sold'] >= $ico['quant'])
			{
				$ico['status'] = 2;
			}
			$ico->save();

			if($user->refer!=0) 
			{
				$gnl = General::first();
				$commision = ($DepositData->amount*$gnl->refcom)/100;

				$refer = User::find($user->refer);
				$refer['balance'] = $refer->balance + $commision;
				$refer->save();
			} 


			$DepositData['status'] = 1;
			$DepositData->save();
		}
	}

}


//CoinGate
public function coingatePayment()
{
	$track = Session::get('Track');

	if (is_null($track))
	{
		return redirect()->back();
	}

	$sellData = Sell::where('trx',$track)->first();

	$ico = Ico::find($sellData->ico_id);
	$amount = $ico->price*$sellData->amount;

	$gateway =Gateway::find(6);
//return $sellData;
	\CoinGate\CoinGate::config(array(
'environment' => 'sandbox', // sandbox OR live
'app_id'      =>  $gateway->val1,
'api_key'     =>  $gateway->val2,
'api_secret'  =>  $gateway->val3
));

	$post_params = array(
		'order_id'          => $sellData->trx,
		'price'             => $amount,
		'currency'          => 'USD',
		'receive_currency'  => 'USD',
		'callback_url'      => route('ipn.coinGate'),
		'cancel_url'        => route('home'),
		'success_url'       => route('home'),
		'title'             => 'Buy ICO #'.$sellData->trx,
		'description'       => 'Buy ICO'
	);

	$order = \CoinGate\Merchant\Order::create($post_params);

	if ($order) 
	{
		return redirect($order->payment_url);
	} else {
		echo "Something Wrong with your API";
	}
}

public function coinGateIPN(Request $request)
{

	$sellData = Sell::where('trx',$request->order_id)->first();
	$ico = Ico::find($sellData->ico_id);
	$amount = $ico->price*$sellData->amount;

	if($request->status=='paid'&&$request->price==$amount && $sellData->status=='0')
	{
		$user = User::find($sellData['user_id']);
		$user['balance'] =  $user['balance'] + $sellData['amount'];
		$user->save(); 

		$ico = Ico::find($sellData->ico_id);
		$ico['sold'] = intval($ico['sold'] + $sellData->amount);
		if($ico['sold'] >= $ico['quant'])
		{
			$ico['status'] = 2;
		}
		$ico->save();

		if($user->refer!=0) 
		{
			$gnl = General::first();
			$commision = ($sellData->amount*$gnl->refcom)/100;

			$refer = User::find($user->refer);
			$refer['balance'] = $refer->balance + $commision;
			$refer->save();
		} 

		$sellData['status'] = 1;
		$sellData->save();

		return redirect()->route('home')->with('success', 'Payment Complete via CoinGate');
	}
}


public function skrillIPN()
{

	$skrill = Gateway::find(5);
	$concatFields = $_POST['merchant_id']
	.$_POST['transaction_id']
	.strtoupper(md5($skrill->val2))
	.$_POST['mb_amount']
	.$_POST['mb_currency']
	.$_POST['status'];

	$sellData = Sell::where('trx',$_POST['transaction_id'])->first();

	if (strtoupper(md5($concatFields)) == $_POST['md5sig'] && $_POST['status'] == 2 && $_POST['pay_to_email'] == $skrill->val1 && $sellData->status='0') {


		$user = User::find($sellData['user_id']);
		$user['balance'] =  $user['balance'] + $sellData['amount'];
		$user->save(); 

		$ico = Ico::find($sellData->ico_id);
		$ico['sold'] = intval($ico['sold'] + $sellData->amount);
		if($ico['sold'] >= $ico['quant'])
		{
			$ico['status'] = 2;
		}
		$ico->save();

		if($user->refer!=0) 
		{
			$gnl = General::first();
			$commision = ($sellData->amount*$gnl->refcom)/100;

			$refer = User::find($user->refer);
			$refer['balance'] = $refer->balance + $commision;
			$refer->save();
		} 

		$sellData['status'] = 1;
		$sellData->save();
	}
}


public function blockIpn(Request $request)
{



	$DepositData = Sell::where('status', 0)->where('gateway_id', 8)->where('try','<=',100)->get();


	$method = Gateway::find(8);
	$apiKey = $method->val1;
$version = 2; // API version
$pin =  $method->val2;
$block_io = new BlockIo($apiKey, $pin, $version);


foreach($DepositData as $data)
{
	$balance = $block_io->get_address_balance(array('addresses' => $data->bcid));


	$bal = $balance->data->available_balance;

	echo $data->bcid."-".$bal.'<br>';


	if($bal > 0 && $bal >= $data->bcam)
	{
		$user = User::find($data['user_id']);
		$user['balance'] =  $user['balance'] + $data['amount'];
		$user->save(); 

		$ico = Ico::find($data->ico_id);
		$ico['sold'] = intval($ico['sold'] + $data->amount);
		if($ico['sold'] >= $ico['quant'])
		{
			$ico['status'] = 2;
		}
		$ico->save();

		if($user->refer!=0) 
		{
			$gnl = General::first();
			$commision = ($data->amount*$gnl->refcom)/100;

			$refer = User::find($user->refer);
			$refer['balance'] = $refer->balance + $commision;
			$refer->save();
		} 

		$data['status'] = 1;
		$data['try'] = $data->try+ 1;
		$data->save();
	}	
	$data['try'] = $data->try + 1;
	$data->save();
}
}

public function cron()
{
	file_get_contents(route('ipn.block'));

}


}	
