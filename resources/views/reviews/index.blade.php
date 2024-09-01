@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista delle Recensioni</h1>
    <table class="table">
        <thead>
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
                    <td>{{ $review->doctor->user->name }}</td>
                    <td>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= $review->stars ? 's' : 'r' }} fa-star text-warning"></i>
                        @endfor
                    </td>
                    <td>{{ $review->review_text }}</td>
                    <td>{{ $review->name_reviewer }}</td>
                    <td>{{ $review->email_reviewer }}</td>
                    <td><a href="{{ route('reviews.show', $review) }}" class="btn btn-primary">Mostra</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
