<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Sponsorizzazione</title>
</head>
<body>
    <h1>Acquista Sponsorizzazione</h1>
    
    <form id="payment-form" action="{{ route('payment.handle') }}" method="POST">
        @csrf
        <!-- Campo per l'importo -->
    <label for="amount">Importo:</label>
    <input type="number" id="amount" name="amount" value="{{ $amount }}" min="1" step="0.01" required readonly>
        
        <!-- Braintree Drop-in container -->
        <div id="dropin-container"></div>

        <!-- Bottone per il pagamento -->
        <button id="submit-button" class="button button--small button--green" type="submit">Paga</button>
    </form>

    <script src="https://js.braintreegateway.com/web/dropin/1.43.0/js/dropin.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var submitButton = document.querySelector('#submit-button');
        
        // Creazione dell'istanza di Braintree Drop-in
        braintree.dropin.create({
            authorization: "{{ $token }}", // Il token generato dal controller
            container: '#dropin-container'
        }, function (err, instance) {
            if (err) {
                console.error(err);
                return;
            }

            // Quando l'utente invia il form
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Richiedi il nonce di pagamento (token di pagamento sicuro)
                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    // Aggiungi il nonce al form come campo nascosto
                    var nonceInput = document.createElement('input');
                    nonceInput.type = 'hidden';
                    nonceInput.name = 'payment_method_nonce';
                    nonceInput.value = payload.nonce;

                    form.appendChild(nonceInput);

                    // Invia il form con il nonce e l'importo al server
                    form.submit();
                });
            });
        });
    </script>
</body>
</html>
