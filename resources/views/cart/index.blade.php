@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Keranjang Belanja</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(count($cartItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($cartItems as $item)
                            @php 
                                                $total = $item->produk->price * $item->quantity;
                                $grandTotal += $total;
                            @endphp
                            <tr>
                                <td>{{ $item->produk->nama }}</td>
                                <td>Rp {{ number_format($item->produk->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->produk_id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button class="btn btn-warning">Kosongkan Keranjang</button>
            </form>
            <form action="{{ route('checkout') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button class="btn btn-success">Checkout</button>
            </form>
        @else
            <p>Keranjang kosong.</p>
        @endif
    </div>
@endsection