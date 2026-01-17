<?php

return [
    [
        'name' => 'Services',
        'flag' => 'service.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'service.create',
        'parent_flag' => 'service.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'service.edit',
        'parent_flag' => 'service.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'service.destroy',
        'parent_flag' => 'service.index',
    ],
];
