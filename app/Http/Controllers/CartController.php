<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $paperBag = $request->paper_bag ? 3500 : 0;

        $subtotal =
            ($product->price * $request->qty)
            + $paperBag;

        Cart::create([
            'user_id'            => Auth::id(),
            'product_id'         => $product->id,
            'qty'                => $request->qty,
            'use_candle'         => $request->use_candle ? 1 : 0,
            'candle_1'           => $request->candle_1,
            'candle_2'           => $request->candle_2,
            'paper_bag'          => $request->paper_bag ? 1 : 0,
            'request_tambahan'   => $request->request_tambahan,
            'price'              => $product->price,
            'subtotal'           => $subtotal,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.cart', compact('carts'));
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang'
        );
    }

    public function increase($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->qty += 1;
        $paperBag = $cart->paper_bag ? 3500 : 0;
        $cart->subtotal =
            ($cart->price * $cart->qty)
            + $paperBag;

        $cart->save();
        return back();
    }

    public function decrease($id)
    {
        $cart = Cart::findOrFail($id);
        if ($cart->qty > 1) {
            $cart->qty -= 1;
            $paperBag = $cart->paper_bag ? 3500 : 0;
            $cart->subtotal =
                ($cart->price * $cart->qty)
                + $paperBag;
            $cart->save();
        }
        
        return back();
    }
}