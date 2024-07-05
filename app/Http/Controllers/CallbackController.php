<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function updateTransaction(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string',
            'status' => 'required|string|in:accepted,failed',
        ]);

        $transaction = Transaction::where('transaction_id', $request->transaction_id)->firstOrFail();
        $transaction->status = $request->status;
        $transaction->save();

        return response()->json($transaction, 200);
    }
}
