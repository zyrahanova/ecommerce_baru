@extends('layouts.dashboard')

@section('content')
    <h1>Checkout</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            Checkout
        </div>
        <div class="card-body">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div id="product" class="mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/') }}" class="card-img-top"
                            alt="">
                        <div class="card-body">
                            <h5 class="card-title">Nama Produk</h5>
                            <p class="card-text">Deskripsi</p>
                            <p class="card-text"><strong>Rp </strong></p>
                            <input type="number" name="product_quantity" id="">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    @endsection
