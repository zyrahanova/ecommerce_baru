@extends('layouts.dashboard')

@section('content')
    <h1>{{ $title }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah Produk
    </button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="product-list" class="container mt-4 row">
        @foreach ($products as $product)
            <div class="card-group col-md-3 m-2">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mx-auto d-block"
                        style="width: 155px; height: 150px; object-fit: center;" alt="{{ $product->name }}">
                    <div class="card-body">
                        <span class="badge badge-primary">{{ $product->category->name }}</span>
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ $product['description'] }}</p>
                        <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                        {{-- <div class="d-flex">
                            <button class="btn btn-warning" data-toggle="modal"
                                data-target="#editModal-{{ route('products.update', $product['id']) }}">Edit</button>
                            <button class="btn btn-danger"
                                onclick="deleteProduct('{{ route('products.destroy', $product['id']) }}')">Delete</button>
                        </div> --}}
                        <form action="{{ route('products.add_to_cart', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Tambah ke Keranjang <i class="fas fa-plus"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
