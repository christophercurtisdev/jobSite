<?php

use App\Http\Controllers\Backend\JobTypeController;

use App\Models\JobType;

Route::bind('job_type', function ($value) {
	$job_type = new JobType;

	return JobType::withTrashed()->where($job_type->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'job_types'], function () {
	Route::get(	'', 		[JobTypeController::class, 'index']		)->name('job_types.index');
    Route::get(	'create', 	[JobTypeController::class, 'create']	)->name('job_types.create');
	Route::post('store', 	[JobTypeController::class, 'store']		)->name('job_types.store');
    Route::get(	'deleted', 	[JobTypeController::class, 'deleted']	)->name('job_types.deleted');
});

Route::group(['prefix' => 'job_types/{job_type}'], function () {
	// JobType
	Route::get('/', [JobTypeController::class, 'show'])->name('job_types.show');
	Route::get('edit', [JobTypeController::class, 'edit'])->name('job_types.edit');
	Route::patch('update', [JobTypeController::class, 'update'])->name('job_types.update');
	Route::delete('destroy', [JobTypeController::class, 'destroy'])->name('job_types.destroy');
	// Deleted
	Route::get('restore', [JobTypeController::class, 'restore'])->name('job_types.restore');
	Route::get('delete', [JobTypeController::class, 'delete'])->name('job_types.delete-permanently');
});