@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Transaksi Berhasil</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-success text-white d-inline-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-lg" style="font-size: 40px;"></i>
                        </div>
                        <h5 class="mt-3">Pembayaran telah diterima</h5>
                    </div>

                    <div class="border p-3 mb-4">
                        <h5 class="mb-3">Detail Struk</h5>
                        
                        <div class="mb-3">
                            <p class="mb-1"><strong>No. Transaksi:</strong> #{{ $transaksi->id }}</p>
                            <p class="mb-1"><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksi->details as $detail)
                                    <tr>
                                        <td>{{ $detail->produk->nama }}</td>
                                        <td class="text-center">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $detail->quantity }}</td>
                                        <td class="text-end">Rp {{ number_format($detail->harga * $detail->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th colspan="3" class="text-end">Total</th>
                                        <th class="text-end">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Bayar</th>
                                        <th class="text-end">Rp {{ number_format($bayar, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Kembalian</th>
                                        <th class="text-end">Rp {{ number_format($kembalian, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        <button onclick="window.print()" class="btn btn-secondary ms-2">Cetak Struk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style untuk cetak */
    @media print {
        .btn, header, footer, nav {
            display: none !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        .card-header {
            background-color: #fff !important;
            color: #000 !important;
        }
    }
</style>
@endsection