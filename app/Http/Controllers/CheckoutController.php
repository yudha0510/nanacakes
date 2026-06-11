<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();

        $carts = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        $total = $carts->sum('subtotal');

        // Generate Order Code
        $lastOrder = Order::latest()->first();

        $nextNumber = $lastOrder
            ? $lastOrder->id + 1
            : 1;

        $orderCode = 'NC-' . str_pad(
            $nextNumber,
            4,
            '0',
            STR_PAD_LEFT
        );

        $order = Order::create([
            'user_id'     => $user->id,
            'order_code'  => $orderCode,
            'total_price' => $total,
            'status'      => 'pending',
            'expired_at'  => now()->addHour(),
        ]);

        foreach ($carts as $cart) {

            OrderItem::create([
                'order_id'         => $order->id,
                'product_id'       => $cart->product_id,
                'product_name'     => $cart->product->name,
                'product_image'    => $cart->product->image,
                'qty'              => $cart->qty,
                'price'            => $cart->price,
                'subtotal'         => $cart->subtotal,
                'use_candle'       => $cart->use_candle,
                'candle_1'         => $cart->candle_1,
                'candle_2'         => $cart->candle_2,
                'paper_bag'        => $cart->paper_bag,
                'request_tambahan' => $cart->request_tambahan,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect('/pembayaran')
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}