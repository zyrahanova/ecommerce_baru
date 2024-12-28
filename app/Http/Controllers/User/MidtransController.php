<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransController extends Controller
{
    /**
     * Make request global.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Class constructor.
     *
     * @param \Illuminate\Http\Request $request User Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'shipping_cost' => 'required|numeric|min:10000',
            'courier' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $product = Product::findOrFail($request->product_id);
            $orderId = uniqid();

            $totalPrice = ($product->price * $request->quantity) + $request->shipping_cost;

            $payload = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'item_details' => [
                    [
                        'id' => $product->id,
                        'price' => $product->price,
                        'quantity' => $request->quantity,
                        'name' => $product->name,
                    ],
                    [
                        'id' => 'shipping',
                        'price' => $request->shipping_cost,
                        'quantity' => 1,
                        'name' => 'Ongkir',
                    ],
                ],
            ];

            $snapToken = Snap::getSnapToken($payload);

            $transaction = Transaction::create([
                'order_id' => $orderId,
                'customer_name' => Auth::user()->name,
                'gross_amount' => $totalPrice,
                'courier' => $request->courier ?? null,
                'transaction_status' => 'pending',
                'transaction_time' => now(),
                'snap_token' => $snapToken
            ]);

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function callback(Request $request)
{
    try {
        $notification = new Notification();
        
        // Check if the 'transaction_id' exists in the notification data
        $transactionId = $notification->transaction_id ?? null;
        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;
        $fraudStatus = $notification->fraud_status;

        // Log the received notification data for debugging
        Log::info('Midtrans Callback Data:', $request->all());

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            Log::error('Transaction not found for Order ID: ' . $orderId);
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found',
            ], 404);
        }

        // Process the transaction status update based on the transaction status
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $transaction->transaction_status = 'success';
            } else {
                $transaction->transaction_status = 'failed';
            }
        } elseif ($transactionStatus == 'settlement') {
            $transaction->transaction_status = 'success';
        } elseif ($transactionStatus == 'pending') {
            $transaction->transaction_status = 'pending';
        } elseif ($transactionStatus == 'deny') {
            $transaction->transaction_status = 'failed';
        } elseif ($transactionStatus == 'expire') {
            $transaction->transaction_status = 'expired';
        } elseif ($transactionStatus == 'cancel') {
            $transaction->transaction_status = 'failed';
        }

        $transaction->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction status updated',
        ]);
    } catch (\Exception $e) {
        Log::error('Midtrans Callback Error: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while processing the callback',
        ], 500);
    }
}

}
