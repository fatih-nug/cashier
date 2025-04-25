@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Histori Transaksi</h2>

    @if($histori->isEmpty())
        <p>Belum ada histori transaksi.</p>
    @else
        @foreach($histori as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>ID Transaksi: {{ $item->transaksi_id }}</h5>
                    <p><strong>Total:</strong> Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                    <p><strong>Dibayar:</strong> Rp {{ number_format($item->bayar, 0, ',', '.') }}</p>
                    <p><strong>Kembalian:</strong> Rp {{ number_format($item->kembalian, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $item->created_at->format('d-m-Y H:i') }}</p>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->transaksi->details as $detail)
                                <tr>
                                    <td>{{ $detail->produk->nama }}</td>
                                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>Rp {{ number_format($detail->harga * $detail->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
