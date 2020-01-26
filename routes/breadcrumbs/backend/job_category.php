<?php

Breadcrumbs::for('admin.job_categories.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_job_categories.labels.management'), route('admin.job_categories.index'));
});

Breadcrumbs::for('admin.job_categories.create', function ($trail) {
    $trail->parent('admin.job_categories.index');
    $trail->push(__('backend_job_categories.labels.create'), route('admin.job_categories.create'));
});

Breadcrumbs::for('admin.job_categories.show', function ($trail, $id) {
    $trail->parent('admin.job_categories.index');
    $trail->push(__('backend_job_categories.labels.view'), route('admin.job_categories.show', $id));
});

Breadcrumbs::for('admin.job_categories.edit', function ($trail, $id) {
    $trail->parent('admin.job_categories.index');
    $trail->push(__('backend.job_categories.labels.edit'), route('admin.job_categories.edit', $id));
});

Breadcrumbs::for('admin.job_categories.deleted', function ($trail) {
    $trail->parent('admin.job_categories.index');
    $trail->push(__('backend_job_categories.labels.deleted'), route('admin.job_categories.deleted'));
});
