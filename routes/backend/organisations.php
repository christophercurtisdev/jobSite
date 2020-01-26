<?php

use App\Http\Controllers\Backend\OrganisationController;

use App\Models\Organisation;

Route::bind('organisation', function ($value) {
	$organisation = new Organisation;

	return Organisation::withTrashed()->where($organisation->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'organisations'], function () {
	Route::get(	'', 		[OrganisationController::class, 'index']		)->name('organisations.index');
    Route::get(	'create', 	[OrganisationController::class, 'create']	)->name('organisations.create');
	Route::post('store', 	[OrganisationController::class, 'store']		)->name('organisations.store');
    Route::get(	'deleted', 	[OrganisationController::class, 'deleted']	)->name('organisations.deleted');
});

Route::group(['prefix' => 'organisations/{organisation}'], function () {
	// Organisation
	Route::get('/', [OrganisationController::class, 'show'])->name('organisations.show');
	Route::get('edit', [OrganisationController::class, 'edit'])->name('organisations.edit');
	Route::patch('update', [OrganisationController::class, 'update'])->name('organisations.update');
	Route::delete('destroy', [OrganisationController::class, 'destroy'])->name('organisations.destroy');
	// Deleted
	Route::get('restore', [OrganisationController::class, 'restore'])->name('organisations.restore');
	Route::get('delete', [OrganisationController::class, 'delete'])->name('organisations.delete-permanently');
});