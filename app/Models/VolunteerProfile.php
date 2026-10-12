<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VolunteerProfile extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'user_id',
        'institution_id',
        'unit_id',
        'enrollment_number',
        'full_name',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'course',
        'department',
        'year_of_study',
        'academic_year',
        'blood_group',
        'emergency_contact_name',
        'emergency_contact_phone',
        'status',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(NSSUnit::class);
    }

    public function eventRegistrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function serviceHourRecords(): HasMany
    {
        return $this->hasMany(ServiceHourRecord::class);
    }

    public function activityReports(): HasMany
    {
        return $this->hasMany(ActivityReport::class);
    }
}
