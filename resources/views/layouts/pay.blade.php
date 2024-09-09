<!-- resources/views/layouts/pay.blade.php -->
<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title', 'Pagamento')</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>

<body>

	<!-- Contenuto principale -->
	<main>
		@yield('content') <!-- Qui viene iniettato il contenuto specifico -->
	</main>

	<!-- JS -->
	<script src="{{ asset('js/app.js') }}"></script>
	@yield('script') <!-- Qui vengono iniettati eventuali script -->
</body>

</html>
