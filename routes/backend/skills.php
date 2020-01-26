<?php

use App\Http\Controllers\Backend\SkillController;

use App\Models\Skill;

Route::bind('skill', function ($value) {
	$skill = new Skill;

	return Skill::withTrashed()->where($skill->getRouteKeyName(), $value)->first();
});

Route::group(['prefix' => 'skills'], function () {
	Route::get(	'', 		[SkillController::class, 'index']		)->name('skills.index');
    Route::get(	'create', 	[SkillController::class, 'create']	)->name('skills.create');
	Route::post('store', 	[SkillController::class, 'store']		)->name('skills.store');
    Route::get(	'deleted', 	[SkillController::class, 'deleted']	)->name('skills.deleted');
});

Route::group(['prefix' => 'skills/{skill}'], function () {
	// Skill
	Route::get('/', [SkillController::class, 'show'])->name('skills.show');
	Route::get('edit', [SkillController::class, 'edit'])->name('skills.edit');
	Route::patch('update', [SkillController::class, 'update'])->name('skills.update');
	Route::delete('destroy', [SkillController::class, 'destroy'])->name('skills.destroy');
	// Deleted
	Route::get('restore', [SkillController::class, 'restore'])->name('skills.restore');
	Route::get('delete', [SkillController::class, 'delete'])->name('skills.delete-permanently');
});