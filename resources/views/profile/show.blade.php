@extends('layouts.app')

@section('title', $doctor->user->name . ' ' . $doctor->surname)

@section('content')
	<div class="wrapper pt-3 pb-4">
		<div class="container">
			<div class="card shadow-lg border-0 rounded-lg">
				<div class="row g-0">
					<!-- Sezione Foto del dottore -->
					<div class="col-md-4 bg-light rounded-start">
						<img src="{{ asset('storage/images/' . $doctor->pic) }}"
							alt="Foto di {{ $doctor->user->name }} {{ $doctor->surname }}" class="img-fluid rounded-circle p-4">
					</div>
					<!-- Sezione Informazioni del dottore -->
					<div class="col-md-8">
						<div class="card-body">
							<h2 class="card-title">{{ $doctor->user->name }} {{ $doctor->surname }}</h2>
							<p class="card-text text-muted mb-4">Indirizzo: {{ $doctor->address }}</p>
							<p class="card-text text-muted">Telefono: {{ $doctor->phone }}</p>
							<p class="card-text mt-4">{{ $doctor->bio }}</p>

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
                                <h2>Sponsorizzazione attiva</h2>
                                <p class="mb-1"><strong>Nome:</strong> {{ $sponsorship->pivot->name }}</p>
                                <p class="mb-1"><strong>Prezzo:</strong> €{{ $sponsorship->pivot->price }}</p>
                                <p class="mb-0"><strong>Data Inizio:</strong> {{ $sponsorship->pivot->date_start }}</p>
                                <p class="mb-0"><strong>Data Fine:</strong> {{ $sponsorship->pivot->date_end }}</p>
                                @if ($sponsorship->pivot->name !== 'Gold') <!-- Se non è già Gold, mostra il pulsante di Upgrade -->
                                    <a href="{{ route('sponsorships.create') }}" class="btn btn-success mt-3">Upgrade Sponsorizzazione</a>
                            @endif
                             </div>
                            @else
                            <p class="text-muted mt-4">Nessuna sponsorizzazione attiva.</p>
                            <a href="{{ route('sponsorships.create') }}" class="btn btn-sponsor mt-3">Sponsorizza il Profilo</a>
                            @endif
                            

							<!-- Curriculum Vitae -->
							@if ($doctor->cv)
								<a href="{{ asset('storage/' . $doctor->cv) }}" class="btn btn-primary mt-3 p-2">Visualizza il CV</a>
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
            <div class="card shadow-lg border-0 rounded-lg">
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
		<div class="container mt-5">
			<div class="d-flex justify-content-between mb-3 gap-4">
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
							<p class="text-muted">Nessuna recensione ricevuta.</p>
						@endif
					</div>

					<a href="{{ route('doctors.reviews', $doctor->id) }}" class="btn btn-view-all p-2">Visualizza Tutte le
						Recensioni</a>
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
							<p class="text-muted">Nessun messaggio ricevuto.</p>
						@endif
					</div>

					<a href="{{ route('doctors.messages', $doctor->id) }}" class="btn btn-view-all p-2">Visualizza Tutti i
						Messaggi</a>
				</div>



			</div>
		</div>

	</div>

@endsection
