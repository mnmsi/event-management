<?php

namespace App\Http\Controllers;

use App\Jobs\LogEventUpdate;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class EventController extends Controller
{
    // Display a listing of events
    public function index()
    {
        $events = Event::with('category')->paginate(10);
        return view('events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    // Store a newly created event
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'max_participants' => 'required|integer',
            'registration_fee' => 'required|numeric',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    // Show the form for editing the specified event
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    // Update the specified event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'date'            => 'required|date',
            'location'        => 'required|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'max_participants'=> 'required|integer|min:1',
            'registration_fee'=> 'required|numeric|min:0',
        ]);

        // Store the original values before updating
        $original = $event->getOriginal();

        // Update the event
        $event->update($request->all());

        // Find changed values
        $changes = [];
        foreach ($event->getChanges() as $field => $newValue) {
            if ($field !== 'updated_at') {
                $changes[$field] = [
                    'old' => $original[$field] ?? null,
                    'new' => $newValue,
                ];
            }
        }

        // Dispatch job if there are changes
        if (!empty($changes)) {
            LogEventUpdate::dispatch($event->id, $changes);
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Remove the specified event
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }

    public function addParticipant($eventId)
    {
        $event = Event::findOrFail($eventId);

        if ($event->eventParticipants()->count() >= $event->max_participants) {
            return redirect()->back()->with('error', 'Event is full.');
        }

        if ($event->eventParticipants()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already registered.');
        }

        EventParticipant::create([
            'user_id' => auth()->id(),
            'event_id' => $eventId,
        ]);

        return redirect()->back()->with('success', 'Successfully registered.');
    }
}
