<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Frontend;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
  
    public function index()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
              'faq_title' => 'Dummy Text',
              'faq_details' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        $faqs = Faq::all();
        return view('admin.front.faq', compact('faqs','frontend'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
           [
               'title' => 'required',
               'details' => 'required',
           ]);
        $faq['title'] = $request->title;
        $faq['details'] = $request->details;
        Faq::create($faq);

        return back()->with('success', 'New Faq  Item Created');
    }


    public function update(Request $request, Faq $faq)
    {
        $this->validate($request,
           [
               'title' => 'required',
               'details' => 'required',
           ]);
        $faq['title'] = $request->title;
        $faq['details'] = $request->details;
        $faq->save();

        return back()->with('success', 'Faq Item Updated');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'Faq Item Deleted');
    }
}
