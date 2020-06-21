<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->approve()->publish()->paginate(12);
        return view('all_post')->with(compact('posts'));
    }

    public function posyByCategory($slug){
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->approve()->publish()->get();
        return view('post_by_category')->with(compact('category','posts'));
    }

    public function posyByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->approve()->publish()->get();
        return view('post_by_tag')->with(compact('tag','posts'));
    }


}
