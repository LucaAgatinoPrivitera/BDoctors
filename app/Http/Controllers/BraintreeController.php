<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;

class BraintreeController extends Controller
{
    protected $braintree;

    public function __construct()
    {
        $this->braintree = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
    }

    public function showPaymentForm()
    {
        $token = $this->braintree->ClientToken()->generate();
        return view('payment', ['token' => $token]);
    }

    public function handlePayment(Request $request)
    {
    // Validazione dell'importo e del nonce
    $this->validate($request, [
        'amount' => 'required|numeric|min:0.01',
        'payment_method_nonce' => 'required|string',
    ]);

    try {
        // Esegui la transazione con Braintree
        $result = $this->braintree->transaction()->sale([
            'amount' => $request->input('amount'), // Usa l'importo dal form
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return redirect()->route('payment.success')->with('success', 'Pagamento completato con successo!');
        } else {
            return redirect()->back()->withErrors(['error' => $result->message]);
        }
        } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
 
}
