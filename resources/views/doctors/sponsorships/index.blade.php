@extends('layouts.app')
@section('title', 'Lista dei tipi di sponsorizzazioni')  <!-- Definisce il titolo della pagina -->
@section('content')
<div class="container">
    <h1>Sponsorships</h1>
    <a href="{{ route('sponsorships.create') }}" class="btn btn-primary">Create Sponsorship</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Duration (days)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sponsorships as $sponsorship)
                <tr>
                    <td>{{ $sponsorship->name }}</td>
                    <td>{{ $sponsorship->price }}</td>
                    <td>{{ $sponsorship->duration }}</td>
                    <td>
                        <a href="{{ route('sponsorships.show', $sponsorship->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('sponsorships.edit', $sponsorship->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('sponsorships.destroy', $sponsorship->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection