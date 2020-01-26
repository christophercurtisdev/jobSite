<?php

Breadcrumbs::for('admin.organisations.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('backend_organisations.labels.management'), route('admin.organisations.index'));
});

Breadcrumbs::for('admin.organisations.create', function ($trail) {
    $trail->parent('admin.organisations.index');
    $trail->push(__('backend_organisations.labels.create'), route('admin.organisations.create'));
});

Breadcrumbs::for('admin.organisations.show', function ($trail, $id) {
    $trail->parent('admin.organisations.index');
    $trail->push(__('backend_organisations.labels.view'), route('admin.organisations.show', $id));
});

Breadcrumbs::for('admin.organisations.edit', function ($trail, $id) {
    $trail->parent('admin.organisations.index');
    $trail->push(__('backend.organisations.labels.edit'), route('admin.organisations.edit', $id));
});

Breadcrumbs::for('admin.organisations.deleted', function ($trail) {
    $trail->parent('admin.organisations.index');
    $trail->push(__('backend_organisations.labels.deleted'), route('admin.organisations.deleted'));
});
