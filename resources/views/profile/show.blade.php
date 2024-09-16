@extends('layouts.app')

@section('title', $doctor->user->name . ' ' . $doctor->surname)

@section('content')
	<div class="wrapper  pt-3 pb-4">
		<div class="container">
			<div class="card shadow-lg border-0  uiverse-bg">
				<div class="row g-0">
					<!-- Sezione Foto del dottore -->
					<div class="col-md-4 bg-light rounded-start">
						<img src="{{ asset('storage/images/' . $doctor->pic) }}"
							alt="Foto di {{ $doctor->user->name }} {{ $doctor->surname }}"
							class="img-fluid  p-4 h-100 w-100 object-fit-cover">
					</div>
					<!-- Sezione Informazioni del dottore -->
					<div class="col-md-8">
						<div class="card-body">
							<h2 class="card-title doctor-name mb-4">{{ $doctor->user->name }} {{ $doctor->surname }}</h2>
							<p class="card-text doctor-info mb-4">Indirizzo: {{ $doctor->address }}</p>
							<p class="card-text doctor-info">Telefono: {{ $doctor->phone }}</p>
							<p class="card-text mt-4 doctor-info">{{ $doctor->bio }}</p>

							<!-- Sponsorizzazione attiva -->
							@if ($sponsorship = $doctor->activeSponsorship())
								@php

									$sponsorshipClass = ''; // Classe CSS per lo stile del pannellino

									// Cambia lo stile in base alla sponsorizzazione
									if ($sponsorship->pivot->sponsorship_id === 2) {
									    $sponsorshipClass = 'bg-secondary text-white'; // Colore platino
									} elseif ($sponsorship->pivot->sponsorship_id === 3) {
									    $sponsorshipClass = 'bg-warning text-dark'; // Colore oro
									} else {
									    $sponsorshipClass = 'bg-info text-white'; // Default per Basic
									}
								@endphp

								<div class="alert {{ $sponsorshipClass }} mt-4" role="alert">
									<h2 class=" text-dark">Sponsorizzazione attiva</h2>
									<p class="mb-1 text-dark"><strong>Nome:</strong> {{ $sponsorship->pivot->name }}</p>
									<p class="mb-1 text-dark"><strong>Prezzo:</strong> €{{ $sponsorship->pivot->price }}</p>
									<p class="mb-0 text-dark"><strong>Data Inizio:</strong>
										{{ \Carbon\Carbon::parse($sponsorship->pivot->date_start)->format('d/m/Y H:i') }}</p>
									<p class="mb-0 text-dark"><strong>Data Fine:</strong>
										{{ \Carbon\Carbon::parse($sponsorship->pivot->date_end)->format('d/m/Y H:i') }}</p>
									@if ($sponsorship->pivot->name !== 'Gold')
										<!-- Se non è già Gold, mostra il pulsante di Upgrade -->
										<p class="text-muted mt-4">Nessuna sponsorizzazione attiva.</p>
								<button class="button">
								  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 24">
									<path d="m18 0 8 12 10-8-4 20H4L0 4l10 8 8-12z"></path>
								  </svg>
								  <a href="{{ route('sponsorships.create') }}">Upgrade</a>
								</button>
										
									@endif
								</div>
							@else
								<button class="button">
								  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 24">
									<path d="m18 0 8 12 10-8-4 20H4L0 4l10 8 8-12z"></path>
								  </svg>
								  <a href="{{ route('sponsorships.create') }}">Sponsorizza il Profilo</a>
								</button>
								
							@endif


							<!-- Curriculum Vitae -->
							@if ($doctor->cv)
								<a href="{{ asset('storage/cvs/' . $doctor->cv) }}" target="_blank" class="btn btn-primary mt-3 p-2">
									Visualizza CV
								</a>
							@endif

							<!-- Pulsante per modificare il profilo -->
							<a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning mt-3 ms-0 p-2">Modifica Profilo</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Sezione Specializzazioni -->
		<div class="container mt-5">
			<div class="card shadow-lg border-0 rounded-lg uiverse-bg">
				<div class="card-body">
					<div class="section-title bg-marble text-red">
						<h2>Specializzazioni</h2>
					</div>
					@if ($doctor->specializations->isNotEmpty())
						<ul class="list-group">
							@foreach ($doctor->specializations as $specialization)
								<li class="list-group-item">{{ $specialization->name }}</li>
							@endforeach
						</ul>
					@else
						<p class="text-muted">Nessuna specializzazione aggiunta.</p>
					@endif
				</div>
			</div>
		</div>
		<!-- Sezione Recensioni -->
		<div class="container mt-5  rounded-lg border-0">
			<div class="d-flex justify-content-between mb-3 gap-4 uiverse-bg rounded-lg p-3">
				<div class="d-flex gap-2 flex-md-row flex-column" style="align-items: flex-start">

					<div class="d-block mb-4">
						<h2 class="section-title p-2  mb-2 bg-marble text-red">Ultime Recensioni Ricevute</h2>
						@if ($doctor->reviews->isNotEmpty())
							<ul class="list-group review-list">
								@foreach ($doctor->reviews->sortByDesc('created_at')->take(3) as $review)
									<li class="list-group-item review-item">
										<strong>{{ $review->name_reviewer ?: 'Utente sconosciuto' }} ({{ $review->email_reviewer }}):</strong>
										<p class="mb-0">{{ $review->review_text }}</p>
										<p class="text-muted mb-0">{{ $review->created_at->format('d/m/Y H:i') }}</p>
										<span class="badge bg-primary float-end">{{ $review->stars }} ★</span>
									</li>
								@endforeach
							</ul>
						@else
							<p class="text-muted text-dark">Nessuna recensione ricevuta.</p>
						@endif
						<a href="{{ route('doctors.reviews', $doctor->id) }}" class="btn btn-view-reviews">Visualizza Tutte le
							Recensioni</a>
					</div>

					
				</div>



				<div class="d-flex gap-2 flex-md-row flex-column" style="align-items: flex-start">

					<div class="d-block mb-4">
						<h2 class="section-title p-2  mb-2 bg-marble text-red">Ultimi Messaggi Ricevuti</h2>
						@if ($doctor->messages->isNotEmpty())
							<ul class="list-group message-list">
								@foreach ($doctor->messages->sortByDesc('created_at')->take(3) as $message)
									<li class="list-group-item message-item">
										<strong>Da: {{ $message->name }} ({{ $message->email }})</strong>
										<p class="mb-0">{{ $message->message }}</p>
										<p class="text-muted mb-0">{{ $message->created_at->format('d/m/Y H:i') }}</p>
									</li>
								@endforeach
							</ul>
						@else
							<p class="text-muted text-dark">Nessun messaggio ricevuto.</p>
						@endif
						<a href="{{ route('doctors.messages', $doctor->id) }}" class="btn btn-view-reviews">Visualizza Tutti i
							Messaggi</a>
					</div>

					
				</div>
			</div>
		</div>

	</div>

@endsection
