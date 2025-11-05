<?php

use App\Http\Livewire\PropertyForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyDescriptionController;

Route::get('/', function () {
    return view('landing');
})->name('landing.page');

Route::get('/property-form', PropertyForm::class)->name('property.form');

Route::post('/property-description', [PropertyDescriptionController::class, 'store'])->name('property.description.store');

Route::post('/property-description/regenerate', [PropertyDescriptionController::class, 'regenerate'])->name('property.description.regenerate');