<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    public const SUPER_ADMIN = 'super_admin';
    public const COLLEGE_ADMIN = 'college_admin';
    public const PROGRAMME_OFFICER = 'programme_officer';
    public const EVENT_COORDINATOR = 'event_coordinator';
    public const VOLUNTEER = 'volunteer';

    protected $fillable = ['name', 'description'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
