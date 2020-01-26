<?php

use App\Http\Controllers\Backend\JobCategoryController;

use App\Models\JobCategory;

Route::bind('job_category', function ($value) {
	$job_category = new JobCategory;

	return JobCategory::withTrashed()->where($job_category->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'job_categories'], function () {
	Route::get(	'', 		[JobCategoryController::class, 'index']		)->name('job_categories.index');
    Route::get(	'create', 	[JobCategoryController::class, 'create']	)->name('job_categories.create');
	Route::post('store', 	[JobCategoryController::class, 'store']		)->name('job_categories.store');
    Route::get(	'deleted', 	[JobCategoryController::class, 'deleted']	)->name('job_categories.deleted');
});

Route::group(['prefix' => 'job_categories/{job_category}'], function () {
	// JobCategory
	Route::get('/', [JobCategoryController::class, 'show'])->name('job_categories.show');
	Route::get('edit', [JobCategoryController::class, 'edit'])->name('job_categories.edit');
	Route::patch('update', [JobCategoryController::class, 'update'])->name('job_categories.update');
	Route::delete('destroy', [JobCategoryController::class, 'destroy'])->name('job_categories.destroy');
	// Deleted
	Route::get('restore', [JobCategoryController::class, 'restore'])->name('job_categories.restore');
	Route::get('delete', [JobCategoryController::class, 'delete'])->name('job_categories.delete-permanently');
});