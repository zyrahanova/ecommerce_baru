@extends('layouts.dashboard')

@section('content')
    <h1>Kategori Produk</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
        </ol>
    </nav>
    <div class="container">
        <h2>Edit Kategori</h2>
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Keterangan</label>
                <textarea class="form-control" id="slug" name="slug" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
