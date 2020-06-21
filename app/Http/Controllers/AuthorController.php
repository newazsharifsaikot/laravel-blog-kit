<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function author($username){
        $author = User::where('username',$username)->first();
        $posts = $author->posts()->approve()->publish()->get();
        return view('author_post')->with(compact('author','posts'));

    }



}
