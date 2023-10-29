<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $customer_id = Auth::id();
        $order = Order::where('customer_id', $customer_id)->get();

        return view('order.order', compact('order'));
    }

    public function hapusOrder($id){
        $order = Order::findOrFail($id);

        $order->delete();

        return back();
    }
}
