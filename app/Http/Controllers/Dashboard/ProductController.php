<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Requests\Dashboard\Product\StoreRequest;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setTitle('Products');

        $this->addBreadcrumb('Dashboard', route('dashboard.index'));
        $this->addBreadcrumb('Products');

        $this->data['products'] = Product::with('category')->get();
        $this->data['categories'] = Category::all();

        return view('pages.produk.produk', $this->data);
    }

    // // Halaman produk untuk pelanggan
    // public function customerIndex()
    // {
    //     $products = Product::all();
    //     return view('pages.pelanggan.produk', compact('products'));
    // }

    public function addToCart(Request $request, Product $product)
    {
        $customerId = auth()->id(); // Sesuaikan dengan mekanisme autentikasi Anda

        $cartItem = CartItem::where('product_id', $product->id)
            ->where('customer_id', $customerId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'customer_id' => $customerId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $product = Product::create($validated);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('uploads', 'public');
                $product->image = $imagePath;
            }

            $product->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully',
            ])->setStatusCode(Response::HTTP_CREATED);
        } catch (\throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create product',
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully',
            ])->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product',
            ])->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
