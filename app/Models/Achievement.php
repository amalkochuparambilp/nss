<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'title',
        'description',
        'icon',
        'earned_at',
    ];

    protected function casts(): array
    {
        return [
            'earned_at' => 'date',
        ];
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(VolunteerProfile::class);
    }
}
