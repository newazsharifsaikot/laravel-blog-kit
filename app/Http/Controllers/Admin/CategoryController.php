<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index')->with(compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' =>'required|string|unique:users',
            'image' =>'required|image|mimes:jpg,png,jpeg,bmp'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            $category_image = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category_image);

            if (!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            $slider_image = Image::make($image)->resize(600, 333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider_image);
        }else{
            $imageName = 'default.png';
        }
        $category = new Category();
        $category->name = ucfirst($request->name);
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Created Successfully', 'Success');
        return redirect()->route('admin.category');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit')->with(compact('category'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' =>'required|string|unique:users,name,'.$id,
            'image' =>'image|mimes:jpg,png,jpeg,bmp'
        ]);
        $category = Category::findOrFail($id);
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('category')){
                Storage::disk('public')->makeDirectory('category');
            }
            if (Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
            }
            $category_image = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/'.$imageName,$category_image);

            if (!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            if (Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }
            $slider_image = Image::make($image)->resize(600, 333)->stream();
            Storage::disk('public')->put('category/slider/'.$imageName,$slider_image);
        }else{
            $imageName = $category->image;
        }
        $category->name = ucfirst($request->name);
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Created Successfully', 'Success');
        return redirect()->route('admin.category');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        if (Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }
        if (Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        $category->delete();
        Toastr::success('Category Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
