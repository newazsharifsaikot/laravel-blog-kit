<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::latest()->get();
        return view('admin.tag.index')->with(compact('tags'));
    }

    public function create(){
        return view('admin.tag.create');
    }

    public function store(Request $request){
        $this->validate($request, [
           'name' =>'required|string|unique:tags'
        ]);

        $tag = new Tag();
        $tag->name = ucfirst($request->name);
        $tag->slug = Str::slug($request->name);
        $tag->save();
        Toastr::success('Tag Created Successfully', 'Success');
        return redirect()->route('admin.tag');
    }

    public function edit($id){
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit')->with(compact('tag'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' =>'required|string|unique:tags,name,'.$id
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = ucfirst($request->name);
        $tag->slug = Str::slug($request->name);
        $tag->save();
        Toastr::success('Tag Updated Successfully', 'Success');
        return redirect()->route('admin.tag');
    }

    public function destroy($id){
        $tag = Tag::findOrFail($id);
        if ($tag){
            $tag->delete();
        }
        Toastr::success('Tag Deleted Successfully', 'Success');
        return redirect()->back();
    }

}
