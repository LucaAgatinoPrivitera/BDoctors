<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagamento Sponsorizzazione</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			color: #333;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			padding: 20px;
		}

		h1 {
			color: #333;
			text-align: center;
			margin-bottom: 20px;
		}

		#payment-form {
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
			max-width: 500px;
			width: 100%;
		}

		label {
			display: block;
			font-weight: bold;
			margin-bottom: 10px;
		}

		input[type="number"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: 1px solid #ddd;
			border-radius: 5px;
			font-size: 16px;
		}

		#dropin-container {
			margin-bottom: 20px;
		}

		#submit-button {
			width: 100%;
			padding: 15px;
			background-color: #28a745;
			color: white;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
		}

		#submit-button:hover {
			background-color: #218838;
		}

		/* Responsive Styles */
		@media (max-width: 768px) {
			body {
				padding: 10px;
			}

			#payment-form {
				padding: 15px;
			}

			input[type="number"],
			#submit-button {
				font-size: 14px;
			}

			#submit-button {
				padding: 12px;
			}
		}

		@media (max-width: 480px) {
			h1 {
				font-size: 1.5em;
			}

			#submit-button {
				padding: 10px;
				font-size: 14px;
			}
		}
	</style>
</head>

<body>
	<div class="d-block">
		<h1>Acquista Sponsorizzazione</h1>

		<form id="payment-form" action="{{ route('payment.handle') }}" method="POST">
			@csrf
			<!-- Campo per l'importo -->
			<label for="amount">Importo:</label>
			<input type="number" id="amount" name="amount" value="{{ $amount }}" min="1" step="0.01"
				required readonly>

			<!-- Braintree Drop-in container -->
			<div id="dropin-container"></div>

			<!-- Bottone per il pagamento -->
			<button id="submit-button" class="button button--small button--green" type="submit">Paga</button>
		</form>
	</div>


	<script src="https://js.braintreegateway.com/web/dropin/1.43.0/js/dropin.js"></script>
	<script>
		var form = document.querySelector('#payment-form');
		var submitButton = document.querySelector('#submit-button');

		// Creazione dell'istanza di Braintree Drop-in
		braintree.dropin.create({
			authorization: "{{ $token }}", // Il token generato dal controller
			container: '#dropin-container'
		}, function(err, instance) {
			if (err) {
				console.error(err);
				return;
			}

			// Quando l'utente invia il form
			form.addEventListener('submit', function(event) {
				event.preventDefault();

				// Richiedi il nonce di pagamento (token di pagamento sicuro)
				instance.requestPaymentMethod(function(err, payload) {
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
