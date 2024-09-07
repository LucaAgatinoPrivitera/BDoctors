{{-- @extends('layouts.app')

@section('title', 'Crea il tuo profilo dottore')

@section('content')
    <h1>Aggiungi il tuo profilo da dottore</h1>
    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="surname">Cognome:</label>
            <input type="text" id="surname" name="surname" value="{{ old('surname') }}">
            @error('surname')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="address">Indirizzo:</label>
            <input type="text" name="address" value="{{ old('address') }}">
            @error('address')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="phone">Numero di Telefono:</label>
            <input type="text" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
			<label for="specializations">Specializzazioni:</label>
			@foreach($specializations as $specialization)
				<div>
					<input type="checkbox" name="specializations[]" value="{{ $specialization->id }}" 
						{{ (old('specializations') && in_array($specialization->id, old('specializations'))) || $selectedSpecialization == $specialization->id ? 'checked' : '' }}>
					<label>{{ $specialization->name }}</label>
				</div>
			@endforeach
			@error('specializations')
				<div>{{ $message }}</div>
			@enderror
		</div>

        <div>
            <label for="pic">Immagine:</label>
            <input type="file" name="pic">
        </div>

        <div>
            <label for="bio">Descrizione:</label>
            <input type="text" name="bio" value="{{ old('bio') }}">
            @error('bio')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Salva</button>
    </form>
@endsection

 --}}
 @extends('layouts.app')

@section('title', 'Crea il tuo profilo dottore')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-primary">Aggiungi il tuo profilo da dottore</h1>
        <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data" class="shadow-lg p-4 bg-white rounded">
            @csrf

            <!-- Cognome -->
            <div class="form-group mb-3">
                <label for="surname" class="form-label">Cognome:</label>
                <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" placeholder="Inserisci il tuo cognome">
                @error('surname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Indirizzo -->
            <div class="form-group mb-3">
                <label for="address" class="form-label">Indirizzo:</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Inserisci il tuo indirizzo">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Numero di Telefono -->
            <div class="form-group mb-3">
                <label for="phone" class="form-label">Numero di Telefono:</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Inserisci il tuo numero di telefono">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Specializzazioni -->
            <div class="form-group mb-3">
                <label for="specializations" class="form-label">Specializzazioni:</label>
                <div class="row">
                    @foreach($specializations as $specialization)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="specializations[]" value="{{ $specialization->id }}" 
                                    {{ (old('specializations') && in_array($specialization->id, old('specializations'))) || $selectedSpecialization == $specialization->id ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $specialization->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('specializations')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Immagine -->
            <div class="form-group mb-3">
                <label for="pic" class="form-label">Immagine:</label>
                <input type="file" name="pic" class="form-control-file">
            </div>

            <!-- CV -->
            <div class="form-group mb-3">
                <label for="cv" class="form-label">Curriculum Vitae:</label>
                <input type="file" name="cv" class="form-control-file">
            </div>

            <!-- Descrizione -->
            <div class="form-group mb-4">
                <label for="bio" class="form-label">Descrizione:</label>
                <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4" placeholder="Inserisci una breve descrizione">{{ old('bio') }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Pulsante di invio -->
            <button type="submit" class="btn btn-primary w-100">Salva</button>
        </form>
    </div>
@endsection

