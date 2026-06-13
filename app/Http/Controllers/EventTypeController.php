<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventTypes = \App\Models\EventType::all();
        return view('master.event_types.index', compact('eventTypes'));
    }

    public function create()
    {
        return view('master.event_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        \App\Models\EventType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('master.event-types.index')->with('success', 'Event Type created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(\App\Models\EventType $eventType)
    {
        return view('master.event_types.edit', compact('eventType'));
    }

    public function update(Request $request, \App\Models\EventType $eventType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $eventType->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('master.event-types.index')->with('success', 'Event Type updated successfully.');
    }

    public function destroy(\App\Models\EventType $eventType)
    {
        $eventType->delete();
        return redirect()->route('master.event-types.index')->with('success', 'Event Type deleted successfully.');
    }
}
