<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lista dei Medici</title>
	<!-- Collegamento a Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
{{-- Da aggiungere utilizzando i yield content e il layout navigation --}}
{{-- @extends('layouts.navigation') --}}

<body style="background-color: #e6f4ea;">
	<div class="container mt-5">
		<h1 class="text-center mb-4">Lista dei Medici</h1>
		<table class="table table-hover table-bordered">
			<thead class="table-dark">
				<tr>
					<th>Nome</th>
					<th>Cognome</th>
					<th>Indirizzo</th>
					<th>Telefono</th>
					<th>Bio</th>
					<th>Foto</th>
					<th>CV</th>
					<th>Info</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($doctors as $doctor)
					<tr>
						<!-- Nome utente -->
						<td class="align-middle">
							{{ $doctor->user ? $doctor->user->name : 'Utente non disponibile' }}
						</td>
						{{-- <p>Nome: {{ $doctor->user ? $doctor->user->name : 'Utente non associato' }}</p> --}}
						<!-- Cognome -->
						<td class="align-middle">{{ $doctor->surname }}</td>
						<!-- Indirizzo -->
						<td class="align-middle">{{ $doctor->address }}</td>
						<!-- Telefono -->
						<td class="align-middle">{{ $doctor->phone }}</td>
						<!-- Bio -->
						<td class="align-middle">{{ $doctor->bio }}</td>
						<!-- Foto con segnaposto -->
						<td class="text-center">
							<img src="{{ $doctor->pic ? asset('storage/images/' . $doctor->pic) : 'https://via.placeholder.com/100' }}"
								alt="Foto di {{ $doctor->user ? $doctor->user->name : 'Medico' }}" class="img-thumbnail" style="height: 100px;">
						</td>
						<!-- Link al CV -->
						<td class="text-center align-middle">
							@if ($doctor->cv)
								<a href="{{ asset('storage/' . $doctor->cv) }}" target="_blank" class="btn btn-primary btn-sm">Visualizza CV</a>
							@else
								<span class="text-muted">Nessun CV disponibile</span>
							@endif
						</td>
						<td class="text-center align-middle">
							<a class="btn btn-success btn-sm" href="{{ route('doctors.show', ['doctor' => $doctor->id]) }}">show</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
