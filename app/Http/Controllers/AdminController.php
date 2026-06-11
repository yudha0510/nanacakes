<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();

        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $totalCustomers = User::where('role', 'user')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $processingOrders = Order::where('status', 'processing')->count();

        $completedOrders = Order::where('status', 'completed')->count();

        $rejectedOrders = Order::where('status', 'rejected')->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'pendingOrders',
            'totalCustomers',
            'recentOrders',
            'processingOrders',
            'completedOrders',
            'rejectedOrders'
        ));
    }
}