<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminPesananController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user','items'])
            ->where('status', 'processing')
            ->latest()
            ->get();

        return view(
            'admin.pesanan',
            compact('orders')
        );
    }

    public function completed($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'completed'
        ]);

        return back()->with(
            'success',
            'Pesanan berhasil diselesaikan.'
        );
    }
}