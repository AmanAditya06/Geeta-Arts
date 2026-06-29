<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string',
            'subtitle' => 'nullable|string|max:255'  
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $request->name,
                "subtitle" => $request->subtitle,
                "price" => $request->price,
                "image" => $request->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => count($cart),
                'message' => 'Item added to cart!'
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function show()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access your cart.');
        }

        $cart = session()->get('cart', []);

        // Calculation Logic
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal > 0 ? 120 : 0;
        $discount = $subtotal > 20000 ? 500 : 0;
        $total = $subtotal + $shipping - $discount;

        // Return with Data
        return view('product_order_screen.cart', compact('cart', 'subtotal', 'shipping', 'discount', 'total'));
    }


    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart!');
    }

    public function clear()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    public function updateQuantity($id, $action)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Item not found');
        }

        if ($action === 'increase') {
            $cart[$id]['quantity']++;
        } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Quantity updated');
    }
}
