<?php

namespace App\Providers;

use App\Policies\AppointmentPolicy;
use App\Policies\ReportPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('ViewAll' , [AppointmentPolicy::class , 'viewAny']);
        Gate::define('delete' , [AppointmentPolicy::class , 'delete']);


        Gate::define('create' , [ReportPolicy::class , 'create']);
        Gate::define('delet' , [ReportPolicy::class , 'delete']);
    }
}
