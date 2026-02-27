<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $owner_id
 * @property string $join_code
 */
class GroupController extends Controller
{
    public function index()
    {
        $groups = Auth::user()->groups()->withCount('members')->get();
        $ownedGroups = Auth::user()->ownedGroups()->withCount('members')->get();

        return view('groups.index', compact('groups', 'ownedGroups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $group = Auth::user()->ownedGroups()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'owner_id' => Auth::id(),
            'join_code' => Str::random(8),
        ]);

        // Maker automatisch lid maken
        $group->members()->attach(Auth::id());

        return redirect()
            ->route('groups.show', $group)
            ->with('success', "Groep '{$group->name}' aangemaakt. Deel deze join-code: <strong>{$group->join_code}</strong>");
    }

    public function show(Group $group): \Illuminate\View\View
    {
        if (! Auth::user()->groups()->where('group_id', $group->getKey())->exists() &&
            $group->owner_id !== Auth::id()) {
            abort(403);
        }

        $group->load(['members', 'appointments' => function ($q) {
            $q->orderBy('date_time', 'asc');
        }]);

        return view('groups.show', compact('group'));
    }

    public function join(Request $request)
    {
        $validated = $request->validate([
            'join_code' => 'required|string|size:8',
        ]);

        $group = Group::where('join_code', $validated['join_code'])->firstOrFail();

        if (Auth::user()->groups()->where('group_id', $group->getKey())->exists()) {
            return back()->with('info', 'Je bent al lid van deze groep.');
        }

        $group->members()->attach(Auth::id());

        return redirect()->route('groups.show', $group)
            ->with('success', 'Je bent succesvol toegetreden tot de groep!');
    }
}
