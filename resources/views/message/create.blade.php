{{-- @extends('layouts.app') 

@section('content')  


<div>

    <div>
        <div class="p-5 mb-4 rounded-3">
            <div class="container py-5">
                <h1 class="display-5 fw-bold">Invia un Email</h1>
                <p class="col-md-8 fs-4">
                    Using a series of utilities, you can create this jumbotron, just
                    like the one in previous versions of Bootstrap. Check out the
                    examples below for how you can remix and restyle it to your liking.
                </p>
            </div>
        </div>
    </div>

    <div class="container pb-5">

        <form>
            <form class="d-flex">
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">Type your name</label>
                        <input type="text" name="" id="" class="form-control" placeholder="Name"
                            aria-describedby="helpId" />
                        <small id="helpId" class="text-muted">Name</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Type your Email</label>
                    <input type="email" class="form-control" name="" id="" aria-describedby="emailHelpId"
                        placeholder="abc@mail.com" />
                    <small id="emailHelpId" class="form-text text-muted">Email</small>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Message</label>
                    <textarea class="form-control" name="" id="" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    Send message
                </button>
            </form>
        </form>
    </div>
</div>
 --}}

@extends('layouts.app')

@section('content')
    <div>
        <div>
            <div class="p-5 px-0 mb-4 rounded-3">
                <div class="container px-0 py-5">
                    <h1 class="display-5 fw-bold">Invia un Email</h1>
                    <p class="col-md-8 fs-4">
                        Utilizzando una serie di utilities, puoi creare questo jumbotron, proprio
                        come quello nelle versioni precedenti di Bootstrap. Controlla gli
                        esempi di seguito per vedere come puoi remixarlo e restylarlo a tuo piacimento.
                    </p>
                </div>
            </div>
        </div>

        <div class="container px-0 pb-5">
            <!-- Corretto: Singolo form con action e method -->
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf <!-- Aggiunge il token CSRF necessario per le richieste POST in Laravel -->

                <!-- Aggiungi il campo per la selezione del dottore -->
                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Seleziona Dottore</label>
                    <select name="doctor_id" id="doctor_id" class="form-control">
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->surname }}</option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name_reviewer" class="form-label">Type your name</label>
                    <input type="text" name="name_reviewer" id="name_reviewer" class="form-control" placeholder="Name"
                        aria-describedby="nameHelp" value="{{ old('name_reviewer') }}" />
                    <small id="nameHelp" class="text-muted">Inserisci il tuo nome</small>
                    @error('name_reviewer')
                        <!-- Mostra errori di convalida per il campo name_reviewer -->
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email_reviewer" class="form-label">Type your Email</label>
                    <input type="email" class="form-control" name="email_reviewer" id="email_reviewer"
                        aria-describedby="emailHelp" placeholder="abc@mail.com" value="{{ old('email_reviewer') }}" />
                    <small id="emailHelp" class="form-text text-muted">Inserisci la tua email</small>
                    @error('email_reviewer')
                        <!-- Mostra errori di convalida per il campo email_reviewer -->
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="3">{{ old('message') }}</textarea>
                    @error('message')
                        <!-- Mostra errori di convalida per il campo message -->
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Send message
                </button>
            </form>
        </div>
    </div>
@endsection
