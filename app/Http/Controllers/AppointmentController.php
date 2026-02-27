<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function store(Request $request, Group $group)
    {
        if (! $group->isMember(auth()->user())) {
            abort(403, 'Je bent geen lid of eigenaar van deze groep.');
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'date_time' => 'required|date|after:now',
            'location' => 'nullable|string|max:255',
        ]);

        $appointment = $group->appointments()->create($validated);

        return redirect()
            ->route('groups.show', $group)
            ->with('success', 'Afspraak succesvol gepland: '.$appointment->subject);
    }

    public function rsvp(Request $request, Appointment $appointment)
    {
        $group = $appointment->group;

        if (! $group->members()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $validated = $request->validate([
            'response' => 'required|in:yes,maybe,no',
        ]);

        $appointment->rsvps()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['response' => $validated['response']]
        );

        return back()->with('success', 'Je aanwezigheid is bijgewerkt.');
    }
}
