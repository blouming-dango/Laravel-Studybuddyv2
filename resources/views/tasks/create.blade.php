@extends('layouts.app')

@section('title', isset($task) ? 'Taak bewerken' : 'Nieuwe taak')

@section('content')
    <h1>{{ isset($task) ? 'Taak bewerken' : 'Nieuwe taak aanmaken' }}</h1>

    <form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
        @csrf
        @if (isset($task)) @method('PUT') @endif

        <div class="form-group">
            <label for="title">Titel *</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title ?? '') }}"
                required />
        </div>

        <div class="form-group">
            <label for="description">Beschrijving</label>
            <textarea id="description" name="description" class="form-control"
                rows="4">{{ old('description', $task->description ?? '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" class="form-control"
                        value="{{ old('deadline', $task->deadline ?? '') }}" />
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="priority">Prioriteit</label>
                    <select name="priority" id="priority" class="form-control" required>
                        <option value="low" {{ old('priority', $task->priority ?? 'low') == 'low' ? 'selected' : '' }}>Laag
                        </option>
                        <option value="medium" {{ old('priority', $task->priority ?? 'low') == 'medium' ? 'selected' : '' }}>
                            Gemiddeld</option>
                        <option value="high" {{ old('priority', $task->priority ?? 'low') == 'high' ? 'selected' : '' }}>Hoog
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="todo" {{ old('status', $task->status ?? 'todo') == 'todo' ? 'selected' : '' }}>Te doen
                        </option>
                        <option value="in_progress" {{ old('status', $task->status ?? 'todo') == 'in_progress' ? 'selected' : '' }}>In uitvoering</option>
                        <option value="done" {{ old('status', $task->status ?? 'todo') == 'done' ? 'selected' : '' }}>Afgerond
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annuleren</a>
    </form>
@endsection