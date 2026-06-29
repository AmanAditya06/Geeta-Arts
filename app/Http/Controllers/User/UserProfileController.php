<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Order; 

class UserProfileController extends Controller
{
    // SHOW PROFILE PAGE
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // ALIAS FOR SHOW (for backward compatibility)
    public function edit()
    {
        return $this->show();
    }

    // UPDATE BASIC INFO
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('password_success', 'Password updated successfully!');
    }

    // SHOW USER ORDERS
    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders ?? [];
        return view('user.orders', compact('orders', 'user'));
    }

    // SHOW ORDER DETAILS
    public function orderDetails(Request $request)
    {
        // You might want to add validation for order_id if needed
        $orderId = $request->query('id');
        $order = null;
        
        if ($orderId) {
            $order = Order::where('user_id', Auth::id())->findOrFail($orderId);
        }
        
        return view('user.order-details', compact('order'));
    }
}
