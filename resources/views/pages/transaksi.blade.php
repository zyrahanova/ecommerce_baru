@extends('layouts.dashboard')

@section('content')
<h1>Transaksi</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
    </ol>
</nav>
<body>

    <div class="container mt-5">
        <!-- Judul Halaman -->
        <div class="text-center mb-4">
            <h1>Riwayat Transaksi</h1>
            <p class="lead">Berikut adalah daftar transaksi Anda.</p>
        </div>

        <!-- Tabel Transaksi -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
@endsection
