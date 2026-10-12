<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VolunteerProfile;

class VolunteerProfilePolicy
{
    public function view(User $user, VolunteerProfile $volunteer): bool
    {
        if ($user->id === $volunteer->user_id) {
            return true;
        }

        if ($user->hasRole(['super_admin', 'college_admin', 'programme_officer'])) {
            return true;
        }

        return false;
    }

    public function update(User $user, VolunteerProfile $volunteer): bool
    {
        if ($user->id === $volunteer->user_id) {
            return true;
        }

        if ($user->hasRole(['super_admin', 'college_admin', 'programme_officer'])) {
            return true;
        }

        return false;
    }

    public function approve(User $user, VolunteerProfile $volunteer): bool
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole(['college_admin', 'programme_officer'])) {
            return true;
        }

        return false;
    }
}
