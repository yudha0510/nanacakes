<?php

namespace App\Http\Controllers;

use App\Models\Order;

class RiwayatAdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])
            ->whereIn('status', [
                'completed',
                'cancelled'
            ])
            ->latest()
            ->get();

        return view(
            'admin.riwayat',
            compact('orders')
        );
    }
}