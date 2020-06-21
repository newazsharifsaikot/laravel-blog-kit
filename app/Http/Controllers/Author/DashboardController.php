<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $data['user'] = Auth::user();
        $data['posts'] = $data['user']->posts;
        $data['pending'] = $data['posts']->where('is_approve',false)->count();
        $data['view'] = $data['posts']->sum('view_count');
        $data['favorite_posts'] =$data['user']->posts()
            ->withCount('favourite_to_users')
            ->withCount('comments')
            ->orderBy('view_count','desc')
            ->orderBy('favourite_to_users_count','desc')
            ->orderBy('comments_count','desc')
            ->take(5)->get();
        return view('author.dashboard',$data);
    }
}
