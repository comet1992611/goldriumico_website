<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tranlimit;

class TranlimitController extends Controller
{
     public function update(Request $request)
    {
    	$tran = Tranlimit::first();

        $this->validate($request, [
            'coin' => 'required',
        ]);

        $tran['coin'] = $request->coin;
        $tran->save();

        return back()->withSuccess('Trnsaction Limit Updated successfully.');
    }
}
