@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Produk</h2>
        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Quantity</th>
                    <th>Kategori</th>
                    <th>Price</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->quantity }}</td>
                        <td>{{ $produk->kategori->nama }}</td>
                        <td>Rp {{ number_format($produk->price, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')"
                                        class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <form action="{{ route('cart.add', $produk->id) }}" method="POST"
                                    class="d-flex align-items-center gap-1">
                                    @csrf
                                    <input type="number" name="quantity" min="1" max="{{ $produk->quantity }}" value="1"
                                        class="form-control form-control-sm" style="width: 70px;" required>
                                    <button class="btn btn-sm btn-success">+ Keranjang</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection