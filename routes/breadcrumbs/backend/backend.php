<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

require __DIR__.'/job_category.php';
require __DIR__.'/job_sub_category.php';
require __DIR__.'/job.php';
require __DIR__.'/organisation.php';
require __DIR__.'/skill.php';
require __DIR__.'/job_type.php';
require __DIR__.'/job_compensation_type.php';