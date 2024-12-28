<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('user.index', compact('products', 'categories'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('user.pages.details', compact('product'));
    }

    public function cart()
    {
        $carts = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('user.pages.cart', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::updateOrCreate(
            [
                'product_id' => $request->product_id,
                'user_id' => auth()->id(),
            ],
            [
                'quantity' => DB::raw('quantity + ' . $request->quantity),
            ]
        );

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function payment(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        return view('user.pages.payment', compact('product', 'quantity'));
    }
}
