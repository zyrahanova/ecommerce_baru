<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tampilkan semua item keranjang
    public function index()
    {
        $cartItems = CartItem::with('product')->get(); // Ambil semua item keranjang beserta produk
        return view('dashboard.cart.index', compact('cartItems'));
    }

    // Tambahkan item ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cari apakah produk sudah ada di keranjang
        $cartItem = CartItem::where('product_id', $request->product_id)->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->quantity += $request->quantity;
        } else {
            // Jika belum ada, tambahkan item baru
            $cartItem = new CartItem();
            $cartItem->product_id = $request->product_id;
            $cartItem->quantity = $request->quantity;
        }

        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id); // Cari item keranjang berdasarkan ID
        $cartItem->delete(); // Hapus item keranjang

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
