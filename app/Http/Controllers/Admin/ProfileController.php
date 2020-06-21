<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }

    public function update(Request $request){
        $this->validate($request,[
           'name' => 'required|string|min:2',
           'username' => 'required|string|min:2',
           'email' => 'required|email',
           'image' => 'image|mimes:jpeg,png,jpg',
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $user = User::findOrFail(Auth::id());
        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }
            if (Storage::disk('public')->exists('profile/'.$user->image)){
                Storage::disk('public')->delete('profile/'.$user->image);
            }
            $user_image = Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$user_image);
        }else{
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Profile Updated Successfully','Success');
        return redirect()->back();
    }

    public function password_update(Request $request){
        $this->validate($request, [
           'old_password' => 'required',
           'password' => 'required|confirmed'
        ]);

        $old_password = Auth::user()->password;
        $request_password = $request->old_password;
        if (Hash::check($request_password, $old_password)){
            $user = User::findOrFail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->back();
        }else{
            Toastr::error('Old Password Does not match');
            return redirect()->back();
        }
    }
}
