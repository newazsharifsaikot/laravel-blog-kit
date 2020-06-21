<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostDetailsController extends Controller
{
    public function details($slug){
        $post = Post::where('slug',$slug)->approve()->publish()->first();
        $view_key = "saikot-".$post->id;
        if (!Session::has($view_key)){
            $post->increment('view_count');
            Session::put($view_key, 1);
        }
        $randoms = Post::approve()->publish()->take(3)->InRandomOrder()->get();
        return view('post-details')->with(compact('post','randoms'));
    }
}
