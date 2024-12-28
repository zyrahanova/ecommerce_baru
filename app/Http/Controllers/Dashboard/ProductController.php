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

            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'Gagal menambahkan produk.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with('error', 'Gagal menghapus produk.');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->category_id = $validated['category_id'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploads', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }
}
