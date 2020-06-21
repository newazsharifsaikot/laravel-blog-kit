<?php

namespace App\Http\Controllers;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add($id){
       $has_favourite = Auth::user()->favourite_posts()->where('post_id', $id)->count();

       if ($has_favourite == 0){
           Auth::user()->favourite_posts()->attach($id);
           Toastr::success('Post Successfully added to your favourite list','Success');
           return redirect()->back();
       }else{
           Auth::user()->favourite_posts()->detach($id);
           Toastr::success('Post Successfully Removed from your favourite list','Success');
           return redirect()->back();
       }
    }


}
