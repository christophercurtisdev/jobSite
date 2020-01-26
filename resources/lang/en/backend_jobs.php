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
        'created' => 'New Job created',
        'updated' => 'Job updated',
        'deleted' => 'Job was deleted',
        'deleted_permanently' => 'Job was permanently deleted',
        'restored'  => 'Job was restored',
    ],

    'labels'    => [
        'management'    => 'Management of Job',
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
      'main' => 'Job',
      'all' => 'All',
      'create' => 'Create',
      'deleted' => 'Deleted'
    ]
];
