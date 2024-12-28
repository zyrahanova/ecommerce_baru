@extends('user.layouts.app')

@section('content')
    <!-- hero -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="font-bold text-4xl mb-8">{{ $product->name }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col items-center">
                <div class="relative flex justify-center">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover rounded-t-2xl"
                        alt="Event Image" />
                </div>
                <div class="bg-[#535355] rounded-b-2xl p-4 text-gray-700 flex justify-between items-center w-full ">
                    <div class="text-white">
                    </div>
                    <div class="text-white">
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border-2 border-black">
                <h3 class="text-4xl font-semibold mb-8">Aksi</h3>
                <div class="space-y-2">
                    <div class="flex items-center p-2 border bg-[#535355] rounded-xl">
                        <div class="flex-1">
                            <div class="text-white pl-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>

                        <div class="space-y-2">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" id="quantity" min="1" value="1"
                                    class="border rounded p-2 w-20 text-center">

                                <button type="submit"
                                    class="ml-4 bg-white hover:bg-gray-200 text-black px-8 py-2 rounded-xl">
                                    Keranjang
                                </button>
                            </form>
                        </div>

                        <!-- Payment form with hidden quantity input -->
                        <form action="{{ route('payment', ['id' => $product->id]) }}" method="POST">
                          @csrf
                          <input type="hidden" name="product_id" value="{{ $product->id }}">
                          <input type="hidden" id="hiddenQuantity" name="quantity" value="1">
                          
                          <button type="submit" class="inline-flex items-center px-5 py-2 ml-4 text-sm font-medium text-white hover:bg-red-700 bg-red-500 rounded-xl">
                              Beli
                          </button>
                      </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end hero -->

    <!-- description -->
    <section class="container md:px-32 md:py-10 py-7 px-4">
        <div class="flex flex-col text-wrap md:ml-16">
            <h1 class="text-4xl font-bold mb-4">Description</h1>
            <p class="text-xl">
                {{ $product->description }}
            </p>
        </div>
    </section>
    <!-- end description -->

    <script>
        const quantityInput = document.getElementById('quantity');
        const hiddenQuantityInput = document.getElementById('hiddenQuantity');

        quantityInput.addEventListener('input', function() {
            hiddenQuantityInput.value = quantityInput.value;
        });
    </script>
@endsection
