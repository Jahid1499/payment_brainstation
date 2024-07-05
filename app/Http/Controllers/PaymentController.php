<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'user_id' => 'required|integer',
        ]);

        $response = Http::withHeaders([
            'X-Mock-Status' => $request->header('X-Mock-Status', 'accepted'),
        ])->post('http://localhost/api/mock-response');

        $transaction = new Transaction();
        $transaction->user_id = $request->user_id;
        $transaction->amount = $request->amount;
        $transaction->transaction_id = Str::uuid();

        if ($response->status() == 200) {
            $transaction->status = 'accepted';
        } else {
            $transaction->status = 'failed';
        }

        $transaction->save();

        return response()->json($transaction, 200)->header('Cache-Control', 'no-store');
    }
}
