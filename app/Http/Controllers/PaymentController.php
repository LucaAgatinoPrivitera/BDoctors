<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getToken()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('payment', compact('clientToken'));
    }

    public function processPayment(Request $request)
    {
        // Il codice per processare il pagamento va qui
    }

    public function createSponsorship()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('doctors.sponsorships.create', compact('clientToken'));
    }




    public function pay()
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('pay', ['clientToken' => $clientToken]);
    }

    public function checkout(Request $request)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->payment_method_nonce;
        $amount = '10.00'; // Esempio di importo

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return redirect()->back()->with('success', 'Pagamento completato con successo!');
        } else {
            return redirect()->back()->with('error', 'Errore nel pagamento: ' . $result->message);
        }
    }
}
