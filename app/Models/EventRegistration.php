<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventRegistration extends Model
{
    use HasFactory;

    public const STATUS_REGISTERED = 'registered';
    public const STATUS_WAITLISTED = 'waitlisted';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_ATTENDED = 'attended';

    protected $fillable = [
        'event_id',
        'volunteer_id',
        'status',
        'registered_at',
        'waitlist_position',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(VolunteerProfile::class);
    }
}
