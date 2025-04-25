<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\HistoriTransaksi;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::all(); // Ambil semua item dari tabel carts

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        $total = $cartItems->sum(fn($item) => $item->produk->price * $item->quantity);

        $transaksi = Transaksi::create([
            'total' => $total
        ]);

        foreach ($cartItems as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $item->produk_id,
                'quantity' => $item->quantity,
                'harga' => $item->produk->price,
            ]);
        }

        Cart::truncate(); // Hapus semua isi cart

        return redirect()->route('transaksi.show', $transaksi->id);
    }

    public function bayar(Request $request, $id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);

        $request->validate([
            'bayar' => ['required', 'numeric', 'min:' . $transaksi->total],
        ]);

        $bayar = $request->bayar;
        $kembalian = $bayar - $transaksi->total;

        // Kurangi stok produk
        foreach ($transaksi->details as $detail) {
            $produk = Produk::find($detail->produk_id);
            if ($produk) {
                $produk->quantity -= $detail->quantity;
                $produk->save();
            }
        }

        HistoriTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'total' => $transaksi->total,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
        ]);

        return view('transaksi.konfirmasi', compact('transaksi', 'bayar', 'kembalian'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }
}
