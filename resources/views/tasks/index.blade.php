@extends('layouts.app')

@section('title', 'Mijn Taken')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Mijn Taken</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Nieuwe taak toevoegen</a>
    </div>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Titel</th>
                <th>Deadline</th>
                <th>Prioriteit</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') : '-' }}</td>
                    <td>
                        <span
                            class="badge bg-{{ $task->priority === 'high' ? 'danger' : ($task->priority === 'medium' ? 'warning' : 'info') }}">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </td>
                    <td>
                        <span
                            class="badge bg-{{ $task->status === 'done' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'secondary') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Bewerken</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Je hebt nog geen taken aangemaakt.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection