<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request) : \Illuminate\Http\JsonResponse
    {
        $transaction = Transaction::where('order_id', $request->order_id)->first();
        if (!$transaction) {
            return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 200);
        }

        // Jika transaksi berhasil
        if ($request->transaction_status == "settlement") {
            $transaction->transaction_status = "success";
            $transaction->save();

        // Jika transaksi pending
        } else if ($request->transaction_status == "pending") {
            $transaction->transaction_status = "pending";
            $transaction->save();

        // Jika transaksi gagal
        } else {
            $transaction->transaction_status = "failed";
            $transaction->save();

        }
        return response()->json(['status' => 'success']);
    }
}
