@extends('layouts.app')

@section('title', 'Modifica la recensione')

@section('content')
	<div class="container mt-5">
		<div class="card shadow-lg">
			<div class="card-body">
				<h1 class="card-title text-center mb-4">Modifica Recensione per {{ $review->doctor->user->name }}</h1>
				<form action="{{ route('reviews.update', $review->id) }}" method="POST">
					@csrf
					@method('PUT')

					<div class="mb-3">
						<label for="stars" class="form-label">Stelle</label>
						<select name="stars" id="stars" class="form-select" required>
							@for ($i = 1; $i <= 5; $i++)
								<option value="{{ $i }}" {{ $review->stars == $i ? 'selected' : '' }}>
									{{ $i }} {{ $i == 1 ? 'stella' : 'stelle' }}
								</option>
							@endfor
						</select>
					</div>

					<div class="mb-3">
						<label for="review_text" class="form-label">Recensione</label>
						<textarea name="review_text" id="review_text" class="form-control" rows="5" required>{{ $review->review_text }}</textarea>
					</div>

					<div class="mb-3">
						<label for="name_reviewer" class="form-label">Nome Recensore</label>
						<input type="text" name="name_reviewer" id="name_reviewer" class="form-control"
							value="{{ $review->name_reviewer }}" required>
					</div>

					<div class="mb-3">
						<label for="email_reviewer" class="form-label">Email Recensore</label>
						<input type="email" name="email_reviewer" id="email_reviewer" class="form-control"
							value="{{ $review->email_reviewer }}" required>
					</div>

					<div class="text-center mt-4">
						<button type="submit" class="btn btn-primary">Aggiorna Recensione</button>
						<a href="{{ route('reviews.show', $review->id) }}" class="btn btn-secondary">Annulla</a>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
