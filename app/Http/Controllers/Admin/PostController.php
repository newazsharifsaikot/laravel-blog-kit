<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\AdminToAuthor;
use App\Notifications\MailToSubscriber;
use App\Post;
use App\Subscriber;
use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        return view('admin.post.index')->with(compact('posts'));
    }

    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create')->with(compact('categories','tags'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|string|unique:posts',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'categories' => 'required',
            'tags' => 'required',
            'description' => 'required|string',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if (isset($image)){
            $currentTime = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentTime.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            $post_image = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$post_image);

        }else{
            $imageName = 'default.png';
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->is_approve = true;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        //mail to subscribers
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber){
            Notification::route('mail', $subscriber->email)
                ->notify(new MailToSubscriber($post));
        }
        Toastr::success('Post Added Successfully', 'Success');
        return redirect()->route('admin.post');
    }

    public function edit($id){
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::findOrFail($id);
        return view('admin.post.edit')->with(compact('categories','tags','post'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'title' => 'required|string|unique:posts,title,'.$id,
            'image' => 'image|mimes:png,jpg,jpeg',
            'categories' => 'required',
            'tags' => 'required',
            'description' => 'required|string',
        ]);
        $post = Post::findOrFail($id);
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if (isset($image)){
            $currentTime = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentTime.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            if (Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $post_image = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$post_image);

        }else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->is_approve = true;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::success('Post Updated Successfully', 'Success');
        return redirect()->route('admin.post');
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        if (Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();

        $post->delete();
        Toastr::success('Post Deleted Successfully', 'Success');
        return redirect()->back();
    }

    public function show($id){
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.show')->with(compact('post','categories','tags'));
    }

    public function publish($id){
        $post = Post::findOrFail($id);
        if($post->status == false){
            $post->status = true;
            $post->save();
            Toastr::success('Post Publish Successfully', 'Success');
            return redirect()->back();
        }
    }

    public function pending($id){
        $post = Post::findOrFail($id);
        if($post->status == true){
            $post->status = false;
            $post->save();
            Toastr::success('Post Un-publish Successfully', 'Success');
            return redirect()->back();
        }
    }

    public function approval(){
        $posts = Post::where('is_approve', false)->get();
        return view('admin.post.approve')->with(compact('posts'));
    }

    public function approval_post($id){
        $post = Post::findOrFail($id);
        if ($post->is_approve == false){
            $post->is_approve = true;
            $post->save();

            $post->user->notify(new AdminToAuthor($post));
            //mail to subscribers
            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber){
                Notification::route('mail', $subscriber->email)
                    ->notify(new MailToSubscriber($post));
            }

            Toastr::success('Post Approve Successfully', 'Success');
            return redirect()->route('admin.post');
        }
    }



}
