<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'date', 'location', 'category_id', 'max_participants', 'registration_fee'];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function eventParticipants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function participants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'registrations');
    }
}
