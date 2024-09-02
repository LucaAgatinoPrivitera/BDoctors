@extends('layouts.app')
@section('title', 'Sponsorizzazione: ' . $sponsorship->name)  <!-- Definisce il titolo della pagina -->

@section('content')
<div class="container">
    <h1>{{ $sponsorship->name }}</h1>
    <p>Price: {{ $sponsorship->price }}</p>
    <p>Duration: {{ $sponsorship->duration }} days</p>
    <a href="{{ route('sponsorships.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
