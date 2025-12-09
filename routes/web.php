<?php

use App\Livewire\HealthRecordList;

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Users;
use App\Livewire\HealthRecordForm;
use App\Livewire\ResidentForm;
use App\Livewire\ResidentFormEdit;
use App\Livewire\ResidentList;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->name('admin.')->group(function () {

   
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::prefix('users')->middleware('permission:manage users')->name('users.')->group(function () {
        Route::get('/', Users\Index::class)->name('index');
        Route::get('/create', Users\Create::class)->middleware('permission:create permission')->name('create');
        Route::get('{id}/edit', Users\Edit::class)->name('edit');
    });
    
    Route::get('/residents', ResidentList::class)->name('residents.index');
    Route::get('/residents/create', ResidentForm::class)->name('residents.create')->middleware('official');
    Route::get('/residents/{id}/edit', ResidentFormEdit::class)->name('residents.edit')->middleware('official');
    
    // Health records routes
    Route::get('/health-records', HealthRecordList::class)->name('health-records.index');
    Route::get('/health-records/create', HealthRecordForm::class)->name('health-records.create')->middleware('official');
    Route::get('/health-records/{id}/create', HealthRecordForm::class)->name('health-records.edit')->middleware('official');
    Route::get('/residents/{id}/health-records', HealthRecordList::class)->name('residents.health-records');
});
