<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('produk')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $jumlah = (int) $request->input('quantity', 1); // default 1 jika tidak ada input

        if ($jumlah < 1 || $jumlah > $produk->quantity) {
            return back()->with('error', 'Jumlah tidak valid atau melebihi stok tersedia.');
        }

        $cartItem = Cart::where('produk_id', $id)->first();

        if ($cartItem) {
            $totalQuantity = $cartItem->quantity + $jumlah;
            if ($totalQuantity > $produk->quantity) {
                return back()->with('error', 'Jumlah total di keranjang melebihi stok.');
            }
            $cartItem->increment('quantity', $jumlah);
        } else {
            Cart::create([
                'produk_id' => $id,
                'quantity' => $jumlah
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }


    public function remove($id)
    {
        Cart::where('produk_id', $id)->delete();
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function clear()
    {
        Cart::truncate();
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan!');
    }
}
