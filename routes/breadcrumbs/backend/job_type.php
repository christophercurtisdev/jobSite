<?php

Breadcrumbs::for('admin.job_types.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_job_types.labels.management'), route('admin.job_types.index'));
});

Breadcrumbs::for('admin.job_types.create', function ($trail) {
    $trail->parent('admin.job_types.index');
    $trail->push(__('backend_job_types.labels.create'), route('admin.job_types.create'));
});

Breadcrumbs::for('admin.job_types.show', function ($trail, $id) {
    $trail->parent('admin.job_types.index');
    $trail->push(__('backend_job_types.labels.view'), route('admin.job_types.show', $id));
});

Breadcrumbs::for('admin.job_types.edit', function ($trail, $id) {
    $trail->parent('admin.job_types.index');
    $trail->push(__('backend.job_types.labels.edit'), route('admin.job_types.edit', $id));
});

Breadcrumbs::for('admin.job_types.deleted', function ($trail) {
    $trail->parent('admin.job_types.index');
    $trail->push(__('backend_job_types.labels.deleted'), route('admin.job_types.deleted'));
});
