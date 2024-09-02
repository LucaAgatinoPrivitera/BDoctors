@extends('layouts.app')
@section('title', 'Crea un nuovo tipo di sponsorizzazione')  <!-- Definisce il titolo della pagina -->
@section('content')
<div class="container">
    <h1>Crea tipo di sponsorizzazione</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sponsorships.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="duration">Duration (days)</label>
            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}">
        </div>
        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
</div>
@endsection
