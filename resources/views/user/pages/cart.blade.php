@extends('user.layouts.app')

@section('content')
    <div class="container mx-auto p-4 mb-5">
        <h1 class="font-bold text-4xl mb-8">Keranjang</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 place-items-center">
            @if ($carts->isEmpty())
            <div class="flex flex-col items-center justify-center p-8 my-20">
                <img src="https://via.placeholder.com/150" alt="No products" class="mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Oops, tidak ada Product di keranjang.</h2>
            </div>
        @else
            @forelse ($carts as $cart)
                <div
                    class="w-full max-w-xs mb-6 shadow-xl rounded-lg transform transition-transform duration-300 hover:-translate-y-2">
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden p-2">
                        <!-- Image Section -->
                        <div class="relative">
                            <img src="{{ asset('storage/' . optional($cart->product)->image) }}"
                                alt="{{ optional($cart->product)->name }}" class="w-full h-40 object-cover rounded-t-lg" />
                            <div
                                class="absolute top-2 right-2 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-lg">
                                <span class="text-sm">{{ optional($cart->product)->name }}</span>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="px-4 py-2 bg-[#EA784C] flex justify-between items-center rounded-b-xl">
                            <span class="text-white text-sm font-semibold">Start From</span>
                            <span class="text-[#FFD768] text-xl font-bold">Rp
                                {{ number_format(optional($cart->product)->price, 0, ',', '.') }}</span>
                        </div>

                        <!-- Title and Description -->
                        <div class="p-4">
                            <div class="text-lg font-semibold text-gray-900 text-center">
                                {{ optional($cart->product)->name }}</div>
                            <div class="text-sm text-gray-600 text-center">{{ optional($cart->product)->description }}</div>
                        </div>

                        <!-- Quantity and Buy Button -->
                        <div class="px-4 py-2">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-600">Quantity:</span>
                                <span class="text-lg font-bold text-gray-900">{{ $cart->quantity }}</span>
                            </div>
                            <form action="{{ route('payment', $cart->product->id) }}" method="POST">
                              @csrf
                              <input type="hidden" name="quantity" value="{{ $cart->quantity }}" min="1" class="form-input" />
                              <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                  Beli
                              </button>
                          </form>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center">Keranjang Anda kosong.</p>
            @endforelse
            @endif
        </div>
    </div>
@endsection
