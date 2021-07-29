<?php

return [
    'straight' => [
        'type' => 'workflow',
        'marking_store' => [
            'type' => 'single_state', // or 'single_state', can be omitted to default to workflow type's default
            'property' => 'status', // this is the property on the model, defaults to 'marking'
        ],
        'supports' => ['App\Register'],
        'places' => ['draft', 'review', 'approved', 'rejected'],
        'initial_places' => ['draft'], // defaults to the first place if omitted
        'transitions' => [
            'to_review' => [
                'from' => 'draft',
                'to' => 'review',
            ],
            'approve' => [
                'from' => 'review',
                'to' => 'approved'
            ],
            'reject' => [
                'from' => 'review',
                'to' => 'rejected'
            ]
        ],
    ],
];
