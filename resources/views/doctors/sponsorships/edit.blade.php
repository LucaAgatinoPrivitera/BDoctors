@extends('layouts.app')
@section('title', 'Modifica sponsorizzazione')  <!-- Definisce il titolo della pagina -->
@section('content')
<div class="container">
    <h1>Edit Sponsorship</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sponsorships.update', $sponsorship->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $sponsorship->name) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price', $sponsorship->price) }}" required>
        </div>

        <div class="form-group">
            <label for="duration">Duration (days)</label>
            <input type="number" name="duration" class="form-control" id="duration" value="{{ old('duration', $sponsorship->duration) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Sponsorship</button>
        <a href="{{ route('sponsorships.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
