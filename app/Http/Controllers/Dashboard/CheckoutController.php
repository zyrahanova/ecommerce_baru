<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setTitle('Checkout');

        $this->addBreadcrumb('Dashboard', route('dashboard.index'));
        $this->addBreadcrumb('Checkout');
        return view('dashboard.checkout.index');
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
    public function store(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SANDBOX_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_SANDBOX_CLIENT_KEY');
        Config::$isProduction = false;
        Config::$is3ds = false;

        $productIds = $request->product_id; // Pastikan ini array
        $products = Product::whereIn('id', $productIds)->get();

        $transaction_details = array(
            'order_id' => rand(),
        );
        $item_details = array();

        $total = 0;
        foreach ($products as $p) {
            $total += $p->price;
            $item_details[] = array(
                'id' => $p->id,
                'price' => $p->price,
                'quantity' => 1,
                'name' => $p->name,
            );
        }

        $transaction_details['gross_amount'] = $total;

        $customer_details = array(
            'first_name' => "Arzyra",
            'last_name' => "Hanova",
            'email' => "arzyraazzahanova@gmail.com",
            'phone' => "+628123456",
        );

        $json = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        $snap = Snap::createTransaction($json);
        return redirect($snap->redirect_url);

        $order = Order::create([
            'customer_id' => auth()->user()->customer->id,
            'code' => 'ORD-' . time(),
            'status' => 'pending',
            'order_date' => now(),
            'base_total_price' => $request->base_total_price,
            'shipping_cost' => $request->shipping_cost,
            'grand_total' => $request->base_total_price + $request->shipping_cost,
        ]);

        foreach ($request->cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'qty' => $item['quantity'],
                'base_price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        return redirect()->route('checkout.success', ['order' => $order]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
