@extends('layouts.app')

@section('title', 'Taak bewerken')

@section('content')
    <h1>Taak bewerken</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titel *</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $task->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                rows="4">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" name="deadline" id="deadline"
                    class="form-control @error('deadline') is-invalid @enderror"
                    value="{{ old('deadline', $task->deadline) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label for="priority" class="form-label">Prioriteit</label>
                <select name="priority" id="priority" class="form-select" required>
                    <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Laag</option>
                    <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Gemiddeld</option>
                    <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>Hoog</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="todo" {{ old('status', $task->status) === 'todo' ? 'selected' : '' }}>Te doen</option>
                    <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In uitvoering</option>
                    <option value="done" {{ old('status', $task->status) === 'done' ? 'selected' : '' }}>Afgerond</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annuleren</a>
    </form>
@endsection
