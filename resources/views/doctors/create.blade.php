@extends('layouts.app')

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


