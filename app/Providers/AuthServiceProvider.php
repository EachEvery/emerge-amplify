<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Text' => 'App\Policies\TextPolicy',
        'App\Models\Poem' => 'App\Policies\PoemPolicy',
        'App\Models\Collection' => 'App\Policies\CollectionPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Message' => 'App\Policies\MessagePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
