<?php

namespace App\Providers;

use App\Policies\EntryPolicy;
use App\DataAccess\Eloquent\Entry;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 認可ロジックとしてApp\Policies\EntryPolicyクラスのupdateメソッドを加えます
     */
    protected $policies = [
        Entry::class => EntryPolicy::class,
    ];

    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }
}
