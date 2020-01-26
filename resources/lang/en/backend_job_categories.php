<?php

return [
    'table' => [
        'name'    => 'name',
        'created'       => 'Created',
        'actions'       => 'Actions',
        'last_updated'  => 'Updated',
        'total'         => 'Total|Totals',
        'deleted'       => 'Deleted',
    ],

    'alerts' => [
        'created' => 'New JobCategory created',
        'updated' => 'JobCategory updated',
        'deleted' => 'JobCategory was deleted',
        'deleted_permanently' => 'JobCategory was permanently deleted',
        'restored'  => 'JobCategory was restored',
    ],

    'labels'    => [
        'management'    => 'Management of JobCategory',
        'active'        => 'Active',
        'create'        => 'Create',
        'edit'          => 'Edit',
        'view'          => 'View',
        'name'    => 'name',
        'created_at'    => 'Created at',
        'last_updated'  => 'Updated at',
        'deleted'       => 'Deleted',
    ],

    'validation' => [
        'attributes' => [
            'name' => 'name',
        ]
    ],

    'sidebar' => [
        'title'  => 'Title',
    ],

    'tabs' => [
        'name'    => 'name',
        'content'   => [
            'overview' => [
                'name'    => 'name',
                'created_at'    => 'Created',
                'last_updated'  => 'Updated'
            ],
        ],
    ],

    'menus' => [
      'main' => 'JobCategory',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
