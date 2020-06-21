<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors = User::where('role_id',2)
            ->withCount('posts')
            ->withCount('favourite_posts')
            ->withCount('comments')
            ->get();
        return view('admin.author.index')->with(compact('authors'));
    }

    public function destroy($id){
        $author = User::findOrFail($id);
        $author->delete();
        Toastr::success('Author Deleted Successfully', 'SUccess');
        return redirect()->back();

    }
}
