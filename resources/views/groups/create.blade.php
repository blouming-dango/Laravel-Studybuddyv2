@extends('layouts.app')

@section('title', 'Nieuwe studiegroep aanmaken')

@section('content')
    <h1>Nieuwe studiegroep aanmaken</h1>

    <form action="{{ route('groups.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Naam van de groep *</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving (optioneel)</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                rows="4">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-primary">Groep aanmaken</button>
            <a href="{{ route('groups.index') }}" class="btn btn-secondary">Annuleren</a>
        </div>
    </form>
@endsection