<?php

namespace App\Console\Commands;

use App\Models\DailySummaryLog;
use Illuminate\Console\Command;

class DailySummaryLogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-summary-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current date
        $today = Carbon::today();

        // Get all events created today
        $events = Event::whereDate('created_at', $today)->get();

        // Initialize variables to store total revenue and participants
        $totalRevenue = 0;
        $totalParticipants = 0;

        foreach ($events as $event) {
            $totalRevenue += $event->registration_fee * $event->participants()->count();
            $totalParticipants += $event->participants()->count();
        }

        // Store the daily summary in the database
        DailySummaryLog::create([
            'log_date' => $today,
            'total_revenue' => $totalRevenue,
            'total_participants' => $totalParticipants,
        ]);
    }
}
