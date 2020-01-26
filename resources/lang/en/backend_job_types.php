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
        'created' => 'New JobType created',
        'updated' => 'JobType updated',
        'deleted' => 'JobType was deleted',
        'deleted_permanently' => 'JobType was permanently deleted',
        'restored'  => 'JobType was restored',
    ],

    'labels'    => [
        'management'    => 'Management of JobType',
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
      'main' => 'JobType',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
