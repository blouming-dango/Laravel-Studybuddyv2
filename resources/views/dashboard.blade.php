@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="mb-4">Welkom bij StudyBuddy, {{ auth()->user()->name }}</h1>

    <div class="row">
        <!-- Persoonlijke taken overzicht -->
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Mijn Taken</h5>
                    <h2 class="display-5">{{ $openTasksCount }}</h2>
                    <p class="text-muted">openstaande taken</p>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $completedPercentage }}%;"
                            aria-valuenow="{{ $completedPercentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $completedPercentage }}%
                        </div>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-sm">Bekijk al mijn taken</a>
                </div>
            </div>
        </div>

        <!-- Volgende afspraak -->
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Volgende afspraak</h5>
                    @if ($nextAppointment)
                        <h6>{{ $nextAppointment->subject }}</h6>
                        <p class="mb-1">
                            <strong>{{ \Carbon\Carbon::parse($nextAppointment->date_time)->format('d-m-Y H:i') }}</strong>
                        </p>
                        <p class="mb-0 text-muted">{{ $nextAppointment->location ?? 'Online' }}</p>
                    @else
                        <p class="text-muted">Geen komende afspraken gepland</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mijn groepen -->
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Mijn Studiegroepen</h5>
                    @if ($myGroups->isNotEmpty())
                        <ul class="list-group list-group-flush">
                            @foreach ($myGroups as $group)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $group->name }}
                                    <span class="badge bg-primary rounded-pill">{{ $group->members_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Je zit nog in geen enkele studiegroep</p>
                    @endif
                    <a href="{{ route('groups.index') }}" class="btn btn-outline-primary btn-sm mt-3">Groepen beheren</a>
                </div>
            </div>
        </div>
    </div>
@endsection