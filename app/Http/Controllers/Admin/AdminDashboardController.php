<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;

class AdminDashboardController extends AdminController
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $unreadContacts = Contact::count();

        return view('admin.dashboard.index', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'pendingOrders',
            'recentOrders',
            'unreadContacts'
        ));
    }
}
