<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $fillable = ['user_id', 'event_id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
