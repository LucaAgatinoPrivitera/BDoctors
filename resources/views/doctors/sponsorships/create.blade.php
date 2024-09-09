@extends('layouts.pay')

@section('content')
	<div class="container">
		<h1>Crea Sponsorizzazione</h1>

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form id="payment-form" action="{{ route('checkout') }}" method="POST">
			@csrf
			<div id="dropin-container"></div>
			<input type="hidden" name="payment_method_nonce" id="payment_method_nonce">
			<button type="submit" class="btn btn-success mt-3">Paga</button>
		</form>
	</div>

@section('script')
	<script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			console.log('DOM fully loaded and parsed');

			var form = document.querySelector('#payment-form');
			if (!form) {
				console.error('Form not found');
				return;
			}

			var container = document.querySelector('#dropin-container');
			if (!container) {
				console.error('Drop-in container not found');
				return;
			}

			braintree.dropin.create({
				authorization: "{{ $clientToken }}",
				container: '#dropin-container'
			}, function(createErr, instance) {
				if (createErr) {
					console.error('Error creating drop-in:', createErr);
					return;
				}

				console.log('Drop-in created successfully');

				form.addEventListener('submit', function(event) {
					event.preventDefault(); // Blocca il comportamento di default

					instance.requestPaymentMethod(function(err, payload) {
						if (err) {
							console.error('Error requesting payment method:', err);
							return;
						}

						console.log('Nonce received:', payload.nonce);
						document.querySelector('#payment_method_nonce').value = payload.nonce;
						form.submit(); // Submit dopo aver ottenuto il nonce
					});
				});
			});
		});
	</script>
@endsection
@endsection
