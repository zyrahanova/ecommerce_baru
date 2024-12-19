@extends('layouts.dashboard')

@section('content')
    <h1>Pelanggan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
        </ol>
    </nav>

    <body>
        <div class="container mt-4">
            <h1 class="mb-4">Data Pelanggan</h1>

            <!-- Tambah Pelanggan Button -->
            <div class="mb-3">
                <a href="#" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Pelanggan
                </a>
            </div>

            <!-- Tabel Pelanggan -->
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th>Foto Profil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Dummy -->
                    <tr>
                        <td>1</td>
                        <td>Andi Wijaya</td>
                        <td>Laki-laki</td>
                        <td>andi.wijaya@example.com</td>
                        <td>081234567890</td>
                        <td>Jl. Merdeka No. 10, Jakarta</td>
                        <td>
                            <img src="/images/andi_wijaya.jpg" alt="Andi Wijaya" width="50" class="rounded">
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Rahmawati</td>
                        <td>Perempuan</td>
                        <td>siti.rahma@example.com</td>
                        <td>081987654321</td>
                        <td>Jl. Kebangsaan No. 5, Bandung</td>
                        <td>
                            <img src="/images/siti_rahmawati.png" alt="Siti Rahmawati" width="50" class="rounded">
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
@endsection
