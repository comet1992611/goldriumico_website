<?php

namespace App\Http\Controllers;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   
    public function index()
    {
        $menus = Menu::all();

        return view('admin.interface.menu', compact('menus'));
    }

  
    public function create()
    {
        return view('admin.interface.createmenu');
    }

   
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'order' => 'required|unique:menus',
                'content' => 'required'
            ]);

        $page['name'] = $request-> name;
        $page['order'] = $request-> order;
        $page['content'] = $request-> content;


        Menu::create($page);

        return back()->with('success', 'New Menu Created Successfully!');
    }

   
    public function edit($id)
    {
        $page = Menu::find($id);

        return view('admin.interface.editmenu', compact('page'));
    }


    public function update(Request $request, $id)
    {
        $page = Menu::find($id);

        $this->validate($request,
            [
                'name' => 'required',
                'order' => 'required|unique:menus,order,'. $page->id,
                'content' => 'required'
            ]);

        $page['name'] = $request->name;
        $page['order'] = $request->order;
        $page['content'] = $request->content;


        $page->save();

        return back()->with('success', 'Menu Updated Successfully!');
    }


    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back()->with('success', 'Deleted Successfully!');
    }
}
