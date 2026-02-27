@extends('layouts.app')

@section('title', $group->name)

@section('content')
    <h1>{{ $group->name }}</h1>
    <p class="text-muted">{{ $group->description ?? 'Geen beschrijving beschikbaar' }}</p>

    <p><strong>Join code:</strong> <code>{{ $group->join_code }}</code> (deel dit met klasgenoten)</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Leden {{ $group->members_count }}</h4>
            <ul class="list-group">
                @foreach ($group->members as $member)
                    <li class="list-group-item">{{ $member->name }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h4>Afspraken</h4>
            @if ($group->appointments->isEmpty())
                <p>Nog geen afspraken gepland.</p>
            @else
                <ul class="list-group">
                    @foreach ($group->appointments as $appointment)
                        <li class="list-group-item">
                            <strong>{{ $appointment->subject }}</strong><br>
                            {{ \Carbon\Carbon::parse($appointment->date_time)->format('d-m-Y H:i') }}<br>
                            <small>{{ $appointment->location ?? 'Online' }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Formulier nieuwe afspraak (alleen voor leden) -->
            @if (auth()->check() && $group->isMember(auth()->user()))
                <h5 class="mt-4">Nieuwe afspraak plannen</h5>
                <form action="{{ route('appointments.store', $group) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Onderwerp</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Datum & tijd</label>
                        <input type="datetime-local" name="date_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Locatie / link</label>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Afspraak toevoegen</button>
                </form>
            @endif
        </div>
    </div>
@endsection