@extends('layouts.app')

@section('title', 'Lista delle recensioni')

@section('content')
<div class="container container mt-4">
    <h1 class="text-center mb-4">Lista delle Recensioni</h1>
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Medico</th>
                <th>Stelle</th>
                <th>Recensione</th>
                <th>Nome Recensore</th>
                <th>Email Recensore</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td class="align-middle">{{ $review->doctor->user->name }}</td>
                    <td class="align-middle">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= $review->stars ? 's' : 'r' }} fa-star text-warning"></i>
                        @endfor
                    </td>
                    <td class="align-middle">{{ $review->review_text }}</td>
                    <td class="align-middle">{{ $review->name_reviewer }}</td>
                    <td class="align-middle">{{ $review->email_reviewer }}</td>
                    <td class="align-middle"><a href="{{ route('reviews.show', $review) }}" class="btn btn-primary">Mostra</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
