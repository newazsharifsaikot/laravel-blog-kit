<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $comments = Auth::user()->comments;
        return view('author.comment.index')->with(compact('comments'));
    }
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        if ($comment->user->id == Auth::id()){
            $comment->delete();
            Toastr::success('Comment Deleted Successfully', 'Success');
            return redirect()->back();
        }else{
            Toastr::success('Something Went Wrong', 'Success');
            return redirect()->back();
        }

    }
}
