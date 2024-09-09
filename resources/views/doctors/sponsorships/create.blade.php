@extends('layouts.pay') <!-- Assicurati che il layout sia corretto -->

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
		var form = document.querySelector('#payment-form');
		braintree.dropin.create({
			authorization: "{{ $clientToken }}",
			container: '#dropin-container'
		}, function(createErr, instance) {
			if (createErr) {
				console.error(createErr);
				return;
			}

			form.addEventListener('submit', function(event) {
				console.log('Form submit event triggered');
				event.preventDefault(); // Blocco del comportamento di default
				console.log('Default action prevented');

				instance.requestPaymentMethod(function(err, payload) {
					if (err) {
						console.error(err);
						return;
					}

					console.log('Nonce received:', payload.nonce);
					document.querySelector('#payment_method_nonce').value = payload.nonce;
					form.submit(); // Submit dopo aver ottenuto il nonce
				});
			});

		});
	</script>
@endsection

@endsection
