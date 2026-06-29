<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal > 0 ? 120 : 0;
        $discount = $subtotal > 20000 ? 500 : 0;
        $total = $subtotal + $shipping - $discount;

        return view('checkout.index', compact('cart', 'subtotal', 'shipping', 'discount', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'payment_method' => 'required|in:cash,online',
            'notes' => 'nullable|string|max:1000',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal > 0 ? 120 : 0;
        $discount = $subtotal > 20000 ? 500 : 0;
        $total = $subtotal + $shipping - $discount;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_method'] === 'cash' ? 'pending' : 'paid',
            'shipping_name' => $data['shipping_name'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_city' => $data['shipping_city'],
            'shipping_state' => $data['shipping_state'],
            'shipping_zip' => $data['shipping_zip'],
            'shipping_country' => $data['shipping_country'],
            'notes' => $data['notes'] ?? null,
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.confirmation', $order)->with('success', 'Order placed successfully!');
    }

    public function confirmation(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');

        return view('checkout.confirmation', compact('order'));
    }
}
