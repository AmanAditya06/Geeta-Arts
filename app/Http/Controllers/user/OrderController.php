<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->get();
        return view('user.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');
        return view('user.order-details', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->withErrors(['cancel_error' => 'This order cannot be cancelled as it is already ' . $order->status . '.']);
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('user.orders')->with('success', 'Order #' . $order->order_number . ' has been cancelled successfully.');
    }
}