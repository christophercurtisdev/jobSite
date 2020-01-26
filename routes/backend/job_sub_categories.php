<?php

use App\Http\Controllers\Backend\JobSubCategoryController;

use App\Models\JobSubCategory;

Route::bind('job_sub_category', function ($value) {
	$job_sub_category = new JobSubCategory;

	return JobSubCategory::withTrashed()->where($job_sub_category->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'job_sub_categories'], function () {
	Route::get(	'', 		[JobSubCategoryController::class, 'index']		)->name('job_sub_categories.index');
    Route::get(	'create', 	[JobSubCategoryController::class, 'create']	)->name('job_sub_categories.create');
	Route::post('store', 	[JobSubCategoryController::class, 'store']		)->name('job_sub_categories.store');
    Route::get(	'deleted', 	[JobSubCategoryController::class, 'deleted']	)->name('job_sub_categories.deleted');
});

Route::group(['prefix' => 'job_sub_categories/{job_sub_category}'], function () {
	// JobSubCategory
	Route::get('/', [JobSubCategoryController::class, 'show'])->name('job_sub_categories.show');
	Route::get('edit', [JobSubCategoryController::class, 'edit'])->name('job_sub_categories.edit');
	Route::patch('update', [JobSubCategoryController::class, 'update'])->name('job_sub_categories.update');
	Route::delete('destroy', [JobSubCategoryController::class, 'destroy'])->name('job_sub_categories.destroy');
	// Deleted
	Route::get('restore', [JobSubCategoryController::class, 'restore'])->name('job_sub_categories.restore');
	Route::get('delete', [JobSubCategoryController::class, 'delete'])->name('job_sub_categories.delete-permanently');
});