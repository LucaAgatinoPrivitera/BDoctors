@extends('layouts.app') <!-- Estende il layout principale -->

@section('title', 'Lista dei Medici') <!-- Definisce il titolo della pagina -->

@section('content') <!-- Inizio della sezione content -->
	<div class="container-fluid p-4 mt-4">
		<h1 class="text-center mb-4">Lista dei Medici</h1>

		<!-- Aggiungi la classe table-responsive per rendere la tabella scrollabile su dispositivi piccoli -->
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead class="table-dark">
					<tr>
						<th>Nome</th>
						<th>Cognome</th>
						<th>Indirizzo</th>
						<th>Telefono</th>
						<th>Bio</th>
						<th>Specializzazione</th>
						<th>Foto</th>
						<th>CV</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($doctors as $doctor)
						<tr>
							<!-- Nome utente -->
							<td class="align-middle">{{ $doctor->user ? $doctor->user->name : 'Utente non disponibile' }}</td>
							<!-- Cognome -->
							<td class="align-middle">{{ $doctor->surname }}</td>
							<!-- Indirizzo -->
							<td class="align-middle">{{ $doctor->address }}</td>
							<!-- Telefono -->
							<td class="align-middle">{{ $doctor->phone }}</td>
							<!-- Bio -->
							<td class="align-middle">{{ $doctor->bio }}</td>
							<!-- Specializzazione -->
							<td class="align-middle">
								@if ($doctor->specializations && $doctor->specializations->isNotEmpty())
									{{ $doctor->specializations->pluck('name')->join(', ') }}
								@else
									<span class="text-muted">Nessuna specializzazione</span>
								@endif
							</td>
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
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection <!-- Fine della sezione content -->



<style>
	/* Imposta la tabella come scrollabile orizzontalmente su dispositivi piccoli */
	.table-responsive {
		width: 100%;
		overflow-x: auto;
	}

	/* Gestione delle colonne per i vari dispositivi */
	td,
	th {
		white-space: nowrap;
		/* Impedisce il wrapping del testo per una visualizzazione più compatta */
	}

	/* Adatta le dimensioni dei font e il padding per schermi più piccoli */
	@media (max-width: 575.98px) {
		.table {
			font-size: 0.75rem;
			/* Riduce la dimensione del font su schermi molto piccoli */
		}

		td,
		th {
			padding: 0.5rem;
			/* Riduce il padding per adattare meglio i contenuti */
		}
	}

	@media (min-width: 576px) and (max-width: 767.98px) {
		.table {
			font-size: 0.875rem;
			/* Dimensione del font per schermi piccoli e medi */
		}

		td,
		th {
			padding: 0.75rem;
			/* Padding per schermi piccoli e medi */
		}
	}

	@media (min-width: 768px) and (max-width: 991.98px) {
		.table {
			font-size: 1rem;
			/* Dimensione del font per schermi medi */
		}

		td,
		th {
			padding: 1rem;
			/* Padding per schermi medi */
		}
	}

	@media (min-width: 992px) and (max-width: 1199.98px) {
		.table {
			font-size: 1.125rem;
			/* Dimensione del font per schermi grandi */
		}

		td,
		th {
			padding: 1.25rem;
			/* Padding per schermi grandi */
		}
	}

	@media (min-width: 1200px) {
		.table {
			font-size: 1.25rem;
			/* Dimensione del font per schermi extra-large */
		}

		td,
		th {
			padding: 1.5rem;
			/* Padding per schermi extra-large */
		}
	}
</style>
