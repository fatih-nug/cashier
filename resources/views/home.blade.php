@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="text-center py-3">
                    <div class="display-6 mb-3">Selamat Datang, {{ Auth::user()->name }}!</div>
                    <p class="lead text-muted">Statistik Penjualan</p>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card border-0 bg-primary bg-opacity-10 h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-cash-stack fs-1 text-primary mb-2"></i>
                                <h3 class="fw-bold">{{ \App\Models\Transaksi::count() }}</h3>
                                <p class="text-muted mb-0">Total Penjualan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card border-0 bg-success bg-opacity-10 h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-receipt fs-1 text-success mb-2"></i>
                                <h3 class="fw-bold">{{ \App\Models\TransaksiDetail::sum('quantity') }}</h3>
                                <p class="text-muted mb-0">Produk Terjual</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card border-0 bg-info bg-opacity-10 h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-check fs-1 text-info mb-2"></i>
                                <h3 class="fw-bold">{{ \App\Models\Transaksi::whereDate('created_at', \Carbon\Carbon::today())->count() }}</h3>
                                <p class="text-muted mb-0">Transaksi Hari Ini</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card border-0 bg-danger bg-opacity-10 h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-graph-up-arrow fs-1 text-danger mb-2"></i>
                                <h3 class="fw-bold">Rp {{ number_format(\App\Models\Transaksi::whereDate('created_at', \Carbon\Carbon::today())->sum('total'), 0, ',', '.') }}</h3>
                                <p class="text-muted mb-0">Pendapatan Hari Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
