<?php

Breadcrumbs::for('admin.job_compensation_types.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_job_compensation_types.labels.management'), route('admin.job_compensation_types.index'));
});

Breadcrumbs::for('admin.job_compensation_types.create', function ($trail) {
    $trail->parent('admin.job_compensation_types.index');
    $trail->push(__('backend_job_compensation_types.labels.create'), route('admin.job_compensation_types.create'));
});

Breadcrumbs::for('admin.job_compensation_types.show', function ($trail, $id) {
    $trail->parent('admin.job_compensation_types.index');
    $trail->push(__('backend_job_compensation_types.labels.view'), route('admin.job_compensation_types.show', $id));
});

Breadcrumbs::for('admin.job_compensation_types.edit', function ($trail, $id) {
    $trail->parent('admin.job_compensation_types.index');
    $trail->push(__('backend.job_compensation_types.labels.edit'), route('admin.job_compensation_types.edit', $id));
});

Breadcrumbs::for('admin.job_compensation_types.deleted', function ($trail) {
    $trail->parent('admin.job_compensation_types.index');
    $trail->push(__('backend_job_compensation_types.labels.deleted'), route('admin.job_compensation_types.deleted'));
});
