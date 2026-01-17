<?php

return [
    [
        'name' => 'Clinics',
        'flag' => 'clinic.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'clinic.create',
        'parent_flag' => 'clinic.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'clinic.edit',
        'parent_flag' => 'clinic.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'clinic.destroy',
        'parent_flag' => 'clinic.index',
    ],
];
