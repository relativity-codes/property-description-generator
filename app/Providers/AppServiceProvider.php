<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register any application services here
    }

    public function boot()
    {
        // Bootstrapping any application services here
        Livewire::component('property-form', \App\Http\Livewire\PropertyForm::class);
    }
}