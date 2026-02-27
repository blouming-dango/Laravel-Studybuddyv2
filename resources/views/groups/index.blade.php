@extends('layouts.app')

@section('title', 'Studiegroepen')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Studiegroepen</h1>
        <a href="{{ route('groups.create') }}" class="btn btn-success">Nieuwe groep aanmaken</a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Mijn groepen</h3>
            @if (auth()->user()->groups->isEmpty())
                <p>Je zit nog in geen enkele groep.</p>
            @else
                <div class="list-group">
                    @foreach (auth()->user()->groups as $group)
                        <a href="{{ route('groups.show', $group) }}" class="list-group-item list-group-item-action">
                            <strong>{{ $group->name }}</strong>
                            <span class="badge bg-primary float-end">{{ $group->members_count }} leden</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <h3>Join een groep</h3>
            <form action="{{ route('groups.join') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="join_code" class="form-control" placeholder="Voer join code in" required
                        maxlength="8">
                    <button class="btn btn-primary" type="submit">Joinen</button>
                </div>
            </form>
        </div>
    </div>
@endsection