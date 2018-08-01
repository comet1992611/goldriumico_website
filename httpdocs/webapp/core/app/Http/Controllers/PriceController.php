<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;

class PriceController extends Controller
{
    public function index()
    {
    	$prices = Price::orderBy('id', 'desc')->paginate(10);
    	return view('admin.policy.prices', compact('prices'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'price' => 'required',
            ]);

        $price['price'] = $request->price;
        Price::create($price);

        return back()->with('success', 'New Price Created Successfully!');
    }

    public function destroy(Price $price)
    {
        $price->delete();

        return back()->with('success', 'Price Deleted Successfully!');
    }


}
