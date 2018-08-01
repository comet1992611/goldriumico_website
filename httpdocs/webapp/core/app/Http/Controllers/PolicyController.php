<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;


class PolicyController extends Controller
{
   public function show()
     {
     	$policy = Policy::find(1);
        if($policy == null)
        {
            $default=[
                'privacy' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit',
                'terms' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit'  
            ];
            Policy::create($default);
        }   
     	return view('admin.policy.policy', compact('policy'));
     }

     public function update(Request $request, $id)
        {
            $policy = Policy::find($id);

             $this->validate($request,
                   [
                    'privacy' => 'required',
                    'terms' => 'required'
                    ]);

             $policy['privacy'] = $request-> privacy;
             $policy['terms'] = $request-> terms;

             $policy->save();

           return redirect()->back()->with('success', 'Privacy and Terms Updated Successfully!');
        }
}
