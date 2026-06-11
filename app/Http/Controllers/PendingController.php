<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PendingController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items'])
            ->whereIn('status', [
                'pending',
                'waiting_verification'
            ])
            ->latest()
            ->get();

        return view('admin.pending', compact('orders'));
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'processing'
        ]);

        return back()->with(
            'success',
            'Pesanan berhasil diterima.'
        );
    }

    public function reject(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'reject_reason' => 'required'
        ]);

        $order->update([
            'status'        => 'rejected',
            'reject_reason' => $request->reject_reason,
            'rejected_at'   => now(),
        ]);

        return back()->with(
            'success',
            'Pembayaran ditolak.'
        );
    }
}