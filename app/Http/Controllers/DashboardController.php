<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
    }

    public function userDashboard()
    {
        // Get the events the authenticated user is registered for
        $userEvents = auth()->user()->events;

        return view('user.dashboard', [
            'userEvents' => $userEvents,
        ]);
    }

    public function adminDashboard()
    {
        // Get upcoming events count
        $upcomingEventsCount = Event::where('date', '>', now())->count();

        // Get events where max participants reached
        $maxParticipantsEventsCount = Event::whereHas('registrations', function ($query) {
            $query->groupBy('event_id')->havingRaw('count(*) >= max_participants');
        })->count();

        // Get active categories (categories with upcoming events)
        $activeCategoriesCount = Category::whereHas('events', function ($query) {
            $query->where('date', '>', now());
        })->count();

        // Total revenue
        $totalRevenue = EventParticipant::whereHas('event', function ($query) {
            $query->where('date', '>', now());
        })->sum('registration_fee');

        return view('dashboard.admin', [
            'upcomingEventsCount' => $upcomingEventsCount,
            'maxParticipantsEventsCount' => $maxParticipantsEventsCount,
            'activeCategoriesCount' => $activeCategoriesCount,
            'totalRevenue' => $totalRevenue,
        ]);
    }

}
