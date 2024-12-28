@extends('layouts.dashboard')

@section('content')
    <h1>Transaksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
        </ol>
    </nav>

    <div class="container mt-5">
        <!-- Judul Halaman -->
        <div class="text-center mb-4">
            <h1>Riwayat Transaksi</h1>
            <p class="lead">Berikut adalah daftar transaksi Anda.</p>
        </div>
        
        <div class="justify-between px-0 md:px-16 mb-4">
            <h3>Total Pendapatan : Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <h3>Total Transaksi yang Sukses : {{ $successfulTransactions }}</h3>
            <h3>Total Transaksi yang Belum Sukses : {{ $pendingTransactions }}</h3>
        </div>

        <!-- Tabel Transaksi -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Pendapatan</th>
                        <th>Status</th>
                        <th>Kurir</th>
                        <th>Waktu Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->order_id }}</td>
                            <td>{{ $transaction->customer_name }}</td>
                            <td>Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</td>
                            <td>{{ $transaction->transaction_status }}</td>
                            <td>{{ $transaction->courier }}</td>
                            <td>{{ $transaction->transaction_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
