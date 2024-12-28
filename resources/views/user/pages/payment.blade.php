@extends('user.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Title -->
    <h1 class="font-bold text-4xl mb-8">Detail Pembayaran</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Product Information -->
        <div class="flex flex-col items-center">
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-96 object-cover rounded-lg shadow-md">
            <div class="bg-[#535355] p-4 rounded-b-lg text-white w-full mt-4">
                <h2 class="text-2xl font-semibold">{{ $product->name }}</h2>
                <p class="text-sm mt-2">{{ $product->description }}</p>
            </div>
        </div>
        <!-- Payment Information -->
        <div class="bg-white p-6 rounded-lg shadow-md border">
            <h2 class="text-3xl font-bold mb-6">Payment Summary</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-medium">Harga:</span>
                    <span class="text-gray-900 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-medium">Jumlah:</span>
                    <span class="text-gray-900 font-semibold">{{ $quantity }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-medium">Harga Ongkir:</span>
                    <span class="text-gray-900 font-semibold" id="shipping-cost">Rp 0</span>
                </div>
                <div class="border-t border-gray-300 my-4"></div>
                <div class="flex justify-between items-center text-xl font-bold">
                    <span>Total:</span>
                    <span id="total-price">Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</span>
                </div>
            </div>
            <!-- Shipping Form -->
            <form id="shipping-form" class="mt-6">
                @csrf
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <select id="province_destination" class="form-control">
                        <option value="">Pilih Provinsi Tujuan</option>
                    </select>
                    <select id="city_destination" class="form-control" disabled>
                        <option value="">Pilih Kota Tujuan</option>
                    </select>
                    <select id="courier" class="form-control">
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">Pos Indonesia</option>
                    </select>
                </div>
                <input type="hidden" id="shipping-cost-input" name="shipping_cost" />
                <button type="button" 
                        id="calculate-shipping" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-medium px-6 py-3 rounded-lg">
                    Hitung Harga Ongkir
                </button>
                <div id="loader" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-50 hidden">
                    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-6 w-6"></div>
                </div>
            </form>
            <!-- Payment Form -->
            <button type="button" 
                    id="confirm-purchase" 
                    class="w-full bg-green-600 mt-2 hover:bg-green-700 text-white text-lg font-medium px-6 py-3 rounded-lg" 
                    disabled>
                Bayar
            </button>              
            <a href="{{ route('cart') }}" 
               class="block mt-4 text-center text-gray-600 hover:text-gray-900 text-sm">
                Back to Cart
            </a>
        </div>
    </div>
</div>

@include('user.components.js_part_payment')
@endsection
