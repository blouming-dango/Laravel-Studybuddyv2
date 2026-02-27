<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
    {
        $user = Auth::user();

        // Persoonlijke statistieken
        $openTasksCount = $user->tasks()
            ->where('status', '!=', 'done')
            ->count();

        $totalTasks = $user->tasks()->count();
        $completedPercentage = $totalTasks > 0 
            ? round(($user->tasks()->where('status', 'done')->count() / $totalTasks) * 100, 1) 
            : 0;

        // Volgende afspraak (uit alle groepen waar gebruiker lid van is)
        $nextAppointment = $user->groups()
            ->with(['appointments' => function ($query) {
                $query->where('date_time', '>=', now())
                      ->orderBy('date_time', 'asc');
            }])
            ->get()
            ->pluck('appointments')
            ->flatten()
            ->sortBy('date_time')
            ->first();

        // Mijn groepen met wat basisinfo
        $myGroups = $user->groups()
            ->withCount('members')
            ->with(['appointments' => function ($query) {
                $query->where('date_time', '>=', now())
                      ->orderBy('date_time', 'asc')
                      ->limit(3);
            }])
            ->get();

        return view('dashboard', compact(
            'openTasksCount',
            'completedPercentage',
            'nextAppointment',
            'myGroups'
        ));
    }
}
