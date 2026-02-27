@extends('layouts.app')

@section('title', 'Gebruiker bewerken - ' . $user->name)

@section('content')
    <h1>Gebruiker bewerken: {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Naam</label>
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rol *</label>
            <select name="role" id="role" class="form-select" required>
                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-primary">Wijzigingen opslaan</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuleren</a>
        </div>
    </form>
@endsection