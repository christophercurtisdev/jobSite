<?php

use App\Http\Controllers\Backend\JobController;

use App\Models\Job;

Route::bind('job', function ($value) {
	$job = new Job;

	return Job::withTrashed()->where($job->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'jobs'], function () {
	Route::get(	'', 		[JobController::class, 'index']		)->name('jobs.index');
    Route::get(	'create', 	[JobController::class, 'create']	)->name('jobs.create');
	Route::post('store', 	[JobController::class, 'store']		)->name('jobs.store');
    Route::get(	'deleted', 	[JobController::class, 'deleted']	)->name('jobs.deleted');
});

Route::group(['prefix' => 'jobs/{job}'], function () {
	// Job
	Route::get('/', [JobController::class, 'show'])->name('jobs.show');
	Route::get('edit', [JobController::class, 'edit'])->name('jobs.edit');
	Route::patch('update', [JobController::class, 'update'])->name('jobs.update');
	Route::delete('destroy', [JobController::class, 'destroy'])->name('jobs.destroy');
	// Deleted
	Route::get('restore', [JobController::class, 'restore'])->name('jobs.restore');
	Route::get('delete', [JobController::class, 'delete'])->name('jobs.delete-permanently');
});