<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function view(User $user, Event $event): bool
    {
        return true;
    }

    public function update(User $user, Event $event): bool
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole(['college_admin', 'programme_officer'])) {
            $userInstitution = $user->volunteerProfile?->institution_id
                ?? $user->adminProfile?->institution_id;
            return $event->institution_id === $userInstitution;
        }

        return false;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->hasRole('super_admin');
    }
}
