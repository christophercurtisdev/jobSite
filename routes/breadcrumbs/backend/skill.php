<?php

Breadcrumbs::for('admin.skills.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_skills.labels.management'), route('admin.skills.index'));
});

Breadcrumbs::for('admin.skills.create', function ($trail) {
    $trail->parent('admin.skills.index');
    $trail->push(__('backend_skills.labels.create'), route('admin.skills.create'));
});

Breadcrumbs::for('admin.skills.show', function ($trail, $id) {
    $trail->parent('admin.skills.index');
    $trail->push(__('backend_skills.labels.view'), route('admin.skills.show', $id));
});

Breadcrumbs::for('admin.skills.edit', function ($trail, $id) {
    $trail->parent('admin.skills.index');
    $trail->push(__('backend.skills.labels.edit'), route('admin.skills.edit', $id));
});

Breadcrumbs::for('admin.skills.deleted', function ($trail) {
    $trail->parent('admin.skills.index');
    $trail->push(__('backend_skills.labels.deleted'), route('admin.skills.deleted'));
});
