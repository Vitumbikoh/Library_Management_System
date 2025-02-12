<?php

namespace App\Http\Controllers;

use App\Models\LibraryEvent;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibraryEventController extends Controller
{
    /**
     * Display a listing of the library events.
     */
    public function index(): View
    {
        $events = LibraryEvent::paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new library event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created library event in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        LibraryEvent::create($request->all());

        return redirect()->route('events.index')->with('message', 'Event created successfully');
    }

    /**
     * Show the form for editing the specified library event.
     */
    public function edit(LibraryEvent $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified library event in storage.
     */
    public function update(Request $request, LibraryEvent $event)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('message', 'Event updated successfully');
    }

    /**
     * Remove the specified library event from storage.
     */
    public function destroy(LibraryEvent $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('message', 'Event deleted successfully');
    }
}
