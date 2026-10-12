<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    public const STATUS_ISSUED = 'issued';
    public const STATUS_REVOKED = 'revoked';

    protected $fillable = [
        'recipient_id',
        'issuer_id',
        'certificate_type',
        'event_id',
        'issue_date',
        'reference_number',
        'status',
        'document_path',
        'revoked_at',
        'revocation_reason',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'revoked_at' => 'datetime',
        ];
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(VolunteerProfile::class, 'recipient_id');
    }

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issuer_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
