@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>Modifica: {{ $doctor->surname }}</h1>
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>

		<div class="row">
			<div class="col-12">

				{{-- Questo form non carica una generica rotta "store" ma ha bisogno dell'id del gioco da aggiornare --}}
				<form method="POST" action="{{ route('doctors.update', $doctor) }}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="mb-3">
						<h3 class="form-label">Titolo</h3>
						<input type="text" class="form-control" name="surname" required value="{{ $doctor->surname }}">
						@error('surname')
							<div>{{ $message }}</div>
						@enderror
					</div>
					<div class="mb-3">
						<h3 class="form-label">Descrizione</h3>
						<textarea type="text" class="form-control" name="address" required>{{ $doctor->address }}</textarea>
					</div>

					<div class="mb-3">
						<h3 class="form-label">Telefono</h3>
						<textarea type="text" class="form-control" name="phone" required>{{ $doctor->phone }}</textarea>
					</div>

					<div class="mb-3">
						<h3 class="form-label">Bio</h3>
						<textarea type="text" class="form-control" name="bio" required>{{ $doctor->bio }}</textarea>
					</div>

					<div class="form-group">
						<label for="pic">Immagine</label>
						@if ($doctor->pic)
							<div>
								<img src="{{ Storage::url($doctor->pic) }}" alt="Immagine del medico" style="width: 100px; height: auto;">
								<p>Immagine attuale</p>
							</div>
						@endif
						<input class="btn" type="file" name="pic" class="form-control">
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

			</div>
		</div>
	</div>
@endsection
