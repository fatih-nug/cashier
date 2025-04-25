<?php

namespace App\Http\Controllers;

use App\Models\HistoriTransaksi;

class HistoriTransaksiController extends Controller
{
    public function index()
    {
        $histori = HistoriTransaksi::with('transaksi.details.produk')->latest()->get();
        return view('histori.index', compact('histori'));
    }
}
