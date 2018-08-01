<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\Team;
use Illuminate\Http\Request;
class TeamController extends Controller
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
              'team_title' => 'Dummy Text',
              'team_details' => 'Dummy Text',
           ];
           Frontend::create($default);
           $frontend = Frontend::first();
       }
        $teams = Team::all();
        return view('admin.front.team', compact('teams','frontend'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
           [
               'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               'title' => 'required',
               'details' => 'required',
           ]);
        if($request->hasFile('photo'))
        {
            $team['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/team',$team['photo']);
        }
        $team['title'] = $request->title;
        $team['details'] = $request->details;
        Team::create($team);

        return back()->with('success', 'New Team  Item Created');
    }


    public function update(Request $request, Team $team)
    {
        $this->validate($request,
           [
               'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               'title' => 'required',
               'details' => 'required',
           ]);
       if($request->hasFile('photo'))
        {
        	$path = 'assets/images/team/'.$team->photo;
	        if(file_exists($path))
	        {
	            unlink($path);
	        }
            $team['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move('assets/images/team',$team['photo']);
        }
        $team['title'] = $request->title;
        $team['details'] = $request->details;
        $team->save();

        return back()->with('success', 'Team Item Updated');
    }

    public function destroy(Team $team)
    {
        $path = 'assets/images/team/'.$team->photo;
        if(file_exists($path))
        {
            unlink($path);
        }
        $team->delete();
        return back()->with('success', 'Team Item Deleted');
    }
}
