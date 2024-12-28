@extends('user.layouts.app')

@section('content')
    
    <div id="event-list" class="container mx-auto p-4 mb-5">
        <!-- Check if there are products -->
        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center p-8 my-32">
                <img src="https://via.placeholder.com/150" alt="No products" class="mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Oops, tidak ada Product.</h2>
            </div>
        @else
            <div id="to_ticket" class="grid grid-cols-1 md:grid-cols-3 gap-4 place-items-center">
                @foreach ($products as $product)
                    <a data-aos="" href="{{ route('detail', ['id' => $product->id]) }}" class="w-full max-w-xs mb-6 shadow-xl rounded-lg transform transition-transform duration-300 hover:-translate-y-2">
                        <div class="max-w-xs bg-white rounded-xl shadow-xl overflow-hidden p-2 pt-2">
                            <div class="relative pt-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-full object-cover rounded-t-lg" />
                                <div class="absolute top-2 right-2 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-lg mt-2">
                                    <div class="text-center">
                                        <span class="text-sm">{{ $product->name }}</span><br>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Price Section -->
                            <div class="px-4 py-2 bg-[#EA784C] flex justify-between items-center rounded-b-xl">
                                <span class="text-white text-sm font-semibold">Start From</span>
                                <span class="text-[#FFD768] text-xl font-bold">Rp {{ number_format(20000, 0, ',', '.') }}</span>
                            </div>
            
                            <!-- Title and Location -->
                            <div class="p-4">
                                <div class="text-lg font-semibold text-gray-900 text-center">{{ $product->name }}</div>
                                <div class="text-sm text-gray-600 text-center">{{ $product->description }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
