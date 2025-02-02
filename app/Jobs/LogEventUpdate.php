<?php

namespace App\Jobs;

use App\Models\EventLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class LogEventUpdate implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $eventId,
        protected $changes,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->changes as $field => $values) {
            EventLog::create([
                'event_id'       => $this->eventId,
                'field_updated'  => $field,
                'previous_value' => $values['old'],
                'new_value'      => $values['new'],
            ]);
        }
    }
}
