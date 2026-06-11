<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->whereNotIn('status', [
                'completed',
                'cancelled'
            ])
            ->latest()
            ->get();

        $historyOrders = Order::with('items')
            ->where('user_id', Auth::id())
            ->whereIn('status', [
                'completed',
                'cancelled'
            ])
            ->latest()
            ->get();

        return view(
            'user.pesanan',
            compact(
                'orders',
                'historyOrders'
            )
        );
    }

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $order = Order::where('user_id', Auth::id())
            ->findOrFail($id);

        $image = $request->file('payment_image')
            ->store('payments', 'public');

        $order->update([
            'payment_image' => $image,
            'status' => 'waiting_verification',
        ]);

        return back()->with(
            'success',
            'Bukti pembayaran berhasil dikirim.'
        );
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'cancelled'
        ]);

        return back()->with(
            'success',
            'Pesanan berhasil dibatalkan.'
        );
    }

    public function pembayaran()
    {
        // Auto cancel pending > 1 jam
        Order::where('status', 'pending')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<', now())
            ->update([
                'status' => 'cancelled'
            ]);

        // Auto cancel rejected > 30 menit
        Order::where('status', 'rejected')
            ->whereNotNull('rejected_at')
            ->where('rejected_at', '<', now()->subMinutes(30))
            ->update([
                'status' => 'cancelled'
            ]);

        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->whereIn('status', [
                'pending',
                'waiting_verification',
                'rejected',
                'processing'
            ])
            ->latest()
            ->get();

        return view(
            'user.pembayaran',
            compact('orders')
        );
    }

    public function tracking()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->where('status', 'processing')
            ->latest()
            ->get();

        return view(
            'user.tracking',
            compact('orders')
        );
    }

    public function riwayat()
    {
        $historyOrders = Order::with('items')
            ->where('user_id', Auth::id())
            ->whereIn('status', [
                'completed',
                'cancelled'
            ])
            ->latest()
            ->get();

        return view(
            'user.riwayat',
            compact('historyOrders')
        );
    }
}