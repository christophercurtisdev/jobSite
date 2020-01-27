<?php

use App\Http\Controllers\Backend\JobCompensationTypeController;

use App\Models\JobCompensationType;

Route::bind('job_compensation_type', function ($value) {
	$job_compensation_type = new JobCompensationType;

	return JobCompensationType::withTrashed()->where($job_compensation_type->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'job_compensation_types'], function () {
	Route::get(	'', 		[JobCompensationTypeController::class, 'index']		)->name('job_compensation_types.index');
    Route::get(	'create', 	[JobCompensationTypeController::class, 'create']	)->name('job_compensation_types.create');
	Route::post('store', 	[JobCompensationTypeController::class, 'store']		)->name('job_compensation_types.store');
    Route::get(	'deleted', 	[JobCompensationTypeController::class, 'deleted']	)->name('job_compensation_types.deleted');
});

Route::group(['prefix' => 'job_compensation_types/{job_compensation_type}'], function () {
	// JobCompensationType
	Route::get('/', [JobCompensationTypeController::class, 'show'])->name('job_compensation_types.show');
	Route::get('edit', [JobCompensationTypeController::class, 'edit'])->name('job_compensation_types.edit');
	Route::patch('update', [JobCompensationTypeController::class, 'update'])->name('job_compensation_types.update');
	Route::delete('destroy', [JobCompensationTypeController::class, 'destroy'])->name('job_compensation_types.destroy');
	// Deleted
	Route::get('restore', [JobCompensationTypeController::class, 'restore'])->name('job_compensation_types.restore');
	Route::get('delete', [JobCompensationTypeController::class, 'delete'])->name('job_compensation_types.delete-permanently');
});