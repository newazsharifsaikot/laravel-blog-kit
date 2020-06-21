<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber.index')->with(compact('subscribers'));
    }

    public function destroy($id){
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        Toastr::success('Subscriber Delete Successfully', 'Success');
        return redirect()->back();
    }


}
