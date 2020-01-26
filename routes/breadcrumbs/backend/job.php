<?php

Breadcrumbs::for('admin.jobs.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_jobs.labels.management'), route('admin.jobs.index'));
});

Breadcrumbs::for('admin.jobs.create', function ($trail) {
    $trail->parent('admin.jobs.index');
    $trail->push(__('backend_jobs.labels.create'), route('admin.jobs.create'));
});

Breadcrumbs::for('admin.jobs.show', function ($trail, $id) {
    $trail->parent('admin.jobs.index');
    $trail->push(__('backend_jobs.labels.view'), route('admin.jobs.show', $id));
});

Breadcrumbs::for('admin.jobs.edit', function ($trail, $id) {
    $trail->parent('admin.jobs.index');
    $trail->push(__('backend.jobs.labels.edit'), route('admin.jobs.edit', $id));
});

Breadcrumbs::for('admin.jobs.deleted', function ($trail) {
    $trail->parent('admin.jobs.index');
    $trail->push(__('backend_jobs.labels.deleted'), route('admin.jobs.deleted'));
});
