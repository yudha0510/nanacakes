<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class LaporanController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_price');

        $completedOrders = Order::where('status', 'completed')
            ->count();

        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        $totalCustomers = User::where('role', 'user')
            ->count();

        $sales = Order::with('user')
            ->where('status', 'completed')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.laporan', compact(
            'totalRevenue',
            'completedOrders',
            'monthlyRevenue',
            'totalCustomers',
            'sales'
        ));
    }
}