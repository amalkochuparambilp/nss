<?php

namespace App\Providers;

use App\Models\ServiceHourRecord;
use App\Policies\ServiceHourRecordPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ServiceHourRecord::class => ServiceHourRecordPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
