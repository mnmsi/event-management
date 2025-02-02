<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $upcomingEvents = Event::withCount('registrations')->whereDate('date', '>=', now())->get();
        $fullEvents = Event::withCount('registrations')->having('registrations_count', '>=', DB::raw('max_participants'))->get();
        $activeCategories = Category::withCount('events')->has('events')->get();

        return view('admin.dashboard', compact('upcomingEvents', 'fullEvents', 'activeCategories'));
    }

}
