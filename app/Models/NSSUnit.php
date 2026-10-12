<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NSSUnit extends Model
{
    use HasFactory;

    protected $table = 'nss_units';

    protected $fillable = [
        'institution_id',
        'name',
        'code',
        'description',
        'capacity',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function officers(): HasMany
    {
        return $this->hasMany(OfficerAssignment::class);
    }

    public function volunteers(): HasMany
    {
        return $this->hasMany(VolunteerProfile::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
