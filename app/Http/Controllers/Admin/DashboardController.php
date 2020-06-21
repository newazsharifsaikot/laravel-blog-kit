<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['all_post'] = Post::all()->count();
        $data['category'] = Category::all();
        $data['tag'] = Tag::all();
        $data['author'] = User::where('role_id',2)->count();
        $data['view'] = Post::sum('view_count');
        $data['pending_post'] = Post::where('is_approve',false)->count();
        $data['new_author'] = User::where('role_id',2)->whereDate('created_at', Carbon::today())->count();
        $data['popular_posts'] = Post::withCount('favourite_to_users')
            ->withCount('comments')
            ->orderBy('view_count','desc')
            ->orderBy('favourite_to_users_count','desc')
            ->orderBy('comments_count','desc')
            ->take(5)->get();
        $data['active_authors'] = User::where('role_id',2)
            ->withCount('posts')
            ->withCount('favourite_posts')
            ->withCount('comments')
            ->orderBy('posts_count','desc')
            ->orderBy('favourite_posts_count','desc')
            ->orderBy('comments_count','desc')
            ->take(5)->get();

        return view('admin.dashboard',$data);
    }
}
