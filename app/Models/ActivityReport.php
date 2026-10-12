<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityReport extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'event_id',
        'author_id',
        'title',
        'activity_date',
        'venue',
        'objectives',
        'description',
        'participant_count',
        'outcomes',
        'challenges',
        'review_status',
        'reviewer_comments',
        'reviewer_id',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'reviewed_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(VolunteerProfile::class, 'author_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ReportAttachment::class);
    }
}
