@extends('layouts.app')

@section('title', 'Lista delle recensioni')

@section('content')
	<div class="container-fluid p-4 mt-4">
		<h1 class="text-center mb-4">Lista delle Recensioni</h1>

		<!-- Aggiungi la classe table-responsive per rendere la tabella scrollabile su dispositivi piccoli -->
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead class="table-dark">
					<tr>
						<th>Medico</th>
						<th>Stelle</th>
						<th>Recensione</th>
						<th>Nome Recensore</th>
						<th>Email Recensore</th>
						<th>Azioni</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($reviews as $review)
						<tr>
							<td class="align-middle">{{ $review->doctor->user->name }}</td>
							<td class="align-middle">
								@for ($i = 1; $i <= 5; $i++)
									<i class="fa{{ $i <= $review->stars ? 's' : 'r' }} fa-star text-warning"></i>
								@endfor
							</td>
							<td class="align-middle">{{ $review->review_text }}</td>
							<td class="align-middle">{{ $review->name_reviewer }}</td>
							<td class="align-middle">{{ $review->email_reviewer }}</td>
							<td class="align-middle">
								<a href="{{ route('reviews.show', $review) }}" class="btn btn-primary btn-sm">Mostra</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection


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
</style>
