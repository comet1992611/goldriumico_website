<?php

namespace App\Http\Controllers;

use App\Paymethod;
use App\Payintro;
use Illuminate\Http\Request;

class PaymethodController extends Controller
{
   
    public function index()
    {
        $payin = Payintro::find(1);
        if($payin == null)
        {
            $default=[
                'heading' => 'Payment Method ',
                'details' => 'Payment Method Details Services',
            ];
            Payintro::create($default);
        }
        $payment = Paymethod::all();
        return view('admin.interface.pay', compact('payment', 'payin'));
    }


  
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'payment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        if($request->hasFile('payment'))
        {
            $pay['payment'] = uniqid().'.'.$request->payment->getClientOriginalExtension();
            $request->payment->move('assets/images/paymethod',$pay['payment']);
            Paymethod::create($pay);
            return back()->with('success', 'New Payment Method Icon Added Successfully!');
        }



    }


    public function destroy(Paymethod $paymethod)
    {
         $paymethod->delete();
         unlink('assets/images/paymethod/'.$paymethod->payment);
        return back()->with('success', 'Payment Icon Deleted Successfully!');
    }
}
