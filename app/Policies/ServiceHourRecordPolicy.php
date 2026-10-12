<?php

namespace App\Policies;

use App\Models\ServiceHourRecord;
use App\Models\User;

class ServiceHourRecordPolicy
{
    public function view(User $user, ServiceHourRecord $record): bool
    {
        if ($user->id === $record->volunteer?->user_id) {
            return true;
        }

        if ($user->hasRole(['super_admin', 'college_admin', 'programme_officer'])) {
            return true;
        }

        return false;
    }

    public function update(User $user, ServiceHourRecord $record): bool
    {
        if ($record->approval_status !== ServiceHourRecord::STATUS_PENDING) {
            return false;
        }

        if ($user->hasRole(['super_admin', 'college_admin', 'programme_officer'])) {
            return true;
        }

        return false;
    }
}
