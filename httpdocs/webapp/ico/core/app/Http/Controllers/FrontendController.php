<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frontend;
class FrontendController extends Controller
{
   public function __construct()
    {
        $this->middleware('admin');
    }
    public function banner()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
               'ban_title' => 'Dummy Text',
               'ban_details' => 'Dummy Text',
               'ban_price' => 'Dummy Text',
               'ban_date' => 'Dummy Text',
               'ban_subtitle' => 'Dummy Text',
               'ban_sold' => '10',
           ];
         
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        return view('admin.front.banner', compact('frontend'));
    }

    public function bannerUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'ban_title' => 'required',
               'ban_details' => 'required',
               'ban_price' => 'required',
               'ban_date' => 'required',
                'ban_subtitle' => 'required',
               'ban_sold' => 'required',
           ]);

        $frontend['ban_title'] = $request->ban_title;
        $frontend['ban_details'] = $request->ban_details;
        $frontend['ban_price'] = $request->ban_price;
        $frontend['ban_date'] = $request->ban_date;
        $frontend['ban_subtitle'] = $request->ban_subtitle;
        $frontend['ban_sold'] = $request->ban_sold;
        $frontend->save();

        return back()->with('success', 'Banner Content Updated');
    }

    public function about()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
              'about_title' => 'Dummy Text',
               'video' => 'Dummy Text',
               'about_content' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        return view('admin.front.about', compact('frontend'));
    }

    public function aboutUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
              'about_title' => 'required',
               'video' => 'required',
               'about_content' => 'required',
               'whitepaper' => "mimes:pdf|max:10000"
           ]);

        if($request->hasFile('whitepaper'))
        {
          $path = 'assets/files/white-paper.pdf';
          if(file_exists($path))
          {
              unlink($path);
          }
          $request->whitepaper->move('assets/files/','white-paper.pdf');
        }


        $frontend['about_title'] = $request->about_title;
        $frontend['video'] = $request->video;
        $frontend['about_content'] = $request->about_content;
        $frontend->save();

        return back()->with('success', 'About Content Updated');
    }

     public function subsc()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
                'subs_title' => 'Dummy Text',
               'subs_details' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        return view('admin.front.subsc', compact('frontend'));
    }

    public function subscUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'subs_title' => 'required',
               'subs_details' => 'required',
           ]);

        $frontend['subs_title'] = $request->subs_title;
        $frontend['subs_details'] = $request->subs_details;
        $frontend->save();

        return back()->with('success', 'Subscription Content Updated');
    }
     public function footer()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
                'footer1' => 'Dummy Text',
               'footer2' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        return view('admin.front.footer', compact('frontend'));
    }

    public function footerUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'footer1' => 'required',
               'footer2' => 'required',
           ]);

        $frontend['footer1'] = $request->footer1;
        $frontend['footer2'] = $request->footer2;
        $frontend->save();

        return back()->with('success', 'Footer Content Updated');
    }

    public function background()
    {
        $frontend = Frontend::first();
       if(is_null($frontend))
       {
           $default = [
             'secbg1' => 'No Image',
               'secbg2' => 'No Image',
               'secbg3' => 'No Image',
               'secbg4' => 'No Image',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        return view('admin.front.background', compact('frontend'));
    }

    public function backgroundUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'secbg1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
               'secbg2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
               'secbg3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
               'secbg4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8048',
           ]);

        if($request->hasFile('secbg1'))
        {
          $path = 'assets/images/section/'.$frontend->secbg1;
          if(file_exists($path))
          {
              unlink($path);
          }
            $frontend['secbg1'] = uniqid().'.'.$request->secbg1->getClientOriginalExtension();
            $request->secbg1->move('assets/images/section',$frontend['secbg1']);
        }
         if($request->hasFile('secbg2'))
        {
          $path = 'assets/images/section/'.$frontend->secbg2;
          if(file_exists($path))
          {
              unlink($path);
          }
            $frontend['secbg2'] = uniqid().'.'.$request->secbg2->getClientOriginalExtension();
            $request->secbg2->move('assets/images/section',$frontend['secbg2']);
        }
         if($request->hasFile('secbg3'))
        {
          $path = 'assets/images/section/'.$frontend->secbg3;
          if(file_exists($path))
          {
              unlink($path);
          }
            $frontend['secbg3'] = uniqid().'.'.$request->secbg3->getClientOriginalExtension();
            $request->secbg3->move('assets/images/section',$frontend['secbg3']);
        }
        if($request->hasFile('secbg4'))
        {
          $path = 'assets/images/section/'.$frontend->secbg4;
          if(file_exists($path))
          {
              unlink($path);
          }
            $frontend['secbg4'] = uniqid().'.'.$request->secbg4->getClientOriginalExtension();
            $request->secbg4->move('assets/images/section',$frontend['secbg4']);
        }
        
        $frontend->save();
        return back()->with('success', 'Background Image  Updated');
    }

    public function serviceUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'serv_title' => 'required',
               'serv_details' => 'required',
           ]);

        $frontend['serv_title'] = $request->serv_title;
        $frontend['serv_details'] = $request->serv_details;
        $frontend->save();

        return back()->with('success', 'Service Content Updated');
    } 

    public function roadmapUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'road_title' => 'required',
               'road_details' => 'required',
           ]);

        $frontend['road_title'] = $request->road_title;
        $frontend['road_details'] = $request->road_details;
        $frontend->save();

        return back()->with('success', 'Road Map Content Updated');
    }

    public function teamUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'team_title' => 'required',
               'team_details' => 'required',
           ]);

        $frontend['team_title'] = $request->team_title;
        $frontend['team_details'] = $request->team_details;
        $frontend->save();

        return back()->with('success', 'Team Content Updated');
    }
    public function testmUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'testm_title' => 'required',
               'testm_details' => 'required',
           ]);

        $frontend['testm_title'] = $request->testm_title;
        $frontend['testm_details'] = $request->testm_details;
        $frontend->save();

        return back()->with('success', 'Testimonial Content Updated');
    }
    public function fqsecUpdate(Request $request)
    {
      $frontend = Frontend::first();
        $this->validate($request,
           [
               'faq_title' => 'required',
               'faq_details' => 'required',
           ]);

        $frontend['faq_title'] = $request->faq_title;
        $frontend['faq_details'] = $request->faq_details;
        $frontend->save();

        return back()->with('success', 'Faq Content Updated');
    }

}
