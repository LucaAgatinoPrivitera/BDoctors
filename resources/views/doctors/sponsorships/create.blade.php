@extends('layouts.app')

@section('title', 'Scegli una sponsorizzazione')

@section('content')
<div class="container">
    <h1 class="mb-4">Scegli una Sponsorizzazione</h1>

    <div class="alert alert-info mb-4">
        <h4 class="alert-heading">Potenzia la Tua Visibilità!</h4>
        <p>
            Scegli una delle nostre sponsorizzazioni per aumentare la tua visibilità e attrarre più pazienti. Ogni piano offre vantaggi esclusivi per aiutarti a distinguerti nel nostro elenco di medici.
        </p>
        <ul>
            <li><strong>Basic:</strong> Perfetto per chi inizia e desidera una visibilità di base.</li>
            <li><strong>Premium:</strong> Aumenta significativamente la tua visibilità e attira più pazienti.</li>
            <li><strong>Gold:</strong> Il massimo della visibilità con vantaggi esclusivi per raggiungere il pubblico più ampio.</li>
        </ul>
        <p>Seleziona il piano che meglio si adatta alle tue esigenze e inizia a godere dei benefici immediati.</p>
    </div>

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
        <!-- Campo nascosto per doctor_id -->
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-md-4 mb-4">
                    <div class="card border-1 {{ $sponsorship->name === 'Gold' ? 'bg-warning text-black' : ($sponsorship->name === 'Premium' ? 'bg-secondary text-black' : 'bg-light') }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $sponsorship->name }}</h5>
                            <p class="card-text">
                                Prezzo: €{{ number_format($sponsorship->price, 2) }}<br>
                                Durata: {{ $sponsorship->duration }} giorni
                            </p>
                            <input type="radio" id="sponsorship{{ $sponsorship->id }}" name="sponsorship_id" value="{{ $sponsorship->id }}" required>
                            <label for="sponsorship{{ $sponsorship->id }}" class="form-check-label">
                                Seleziona
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Acquista</button>
    </form>
</div>
@endsection



