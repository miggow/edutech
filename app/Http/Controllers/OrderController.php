<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view('panel.order.index', compact('orders'));
    }
    public function store(Request $request, $id)
    {
        $order = new Order();
        $course = Course::find($id);
        $order->user_id = Auth::id();
        $order->course_id = $id;
        $order->price = $course->price;
        $order->payment_method = $request->payment_method;
        $order->save();
        return redirect()->back()->with('success', ['status' => 1, 'message' => 'Mua thành công!']);
    }
}
