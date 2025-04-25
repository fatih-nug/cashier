@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detail Transaksi #{{ $transaksi->id }}</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="border-bottom pb-2 mb-3">Daftar Produk</h6>
                        
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
                                </tfoot>
                            </table>
                        </div>

                        <form action="{{ route('transaksi.bayar', $transaksi->id) }}" method="POST" class="mt-4">
                            @csrf
                            <h6 class="border-bottom pb-2 mb-3">Jumlah Pembayaran</h6>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('bayar') is-invalid @enderror" 
                                           id="bayar" name="bayar" min="{{ $transaksi->total }}" 
                                           value="{{ old('bayar', $transaksi->total) }}" required>
                                    @error('bayar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Minimal pembayaran: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection