@extends('layouts.dashboard')

@section('content')
<h1>Kontak Kami</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
        </ol>
    </nav>
    <body>
        <div class="container mt-5">
            <!-- Judul Halaman -->
            <div class="text-center mb-4">
                <p class="lead">Silakan hubungi kami melalui formulir di bawah ini atau melalui informasi kontak yang
                    tersedia.</p>
            </div>
            <!-- Formulir Kontak -->
            <div class="col-md-6">
                <h5>Formulir Kontak</h5>
                <form>
                @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Alamat Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
            <div class="row">
                <!-- Informasi Kontak -->
                <div class="text-right col-md-6">
                    <h5>Informasi Kontak</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope"></i> Email: test@example.com</li>
                        <li><i class="fas fa-globe"></i> Website: www.domain.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    @endsection
