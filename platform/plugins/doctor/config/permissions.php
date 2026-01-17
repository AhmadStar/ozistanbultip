<?php

return [
    [
        'name' => 'Doctors',
        'flag' => 'doctor.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'doctor.create',
        'parent_flag' => 'doctor.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'doctor.edit',
        'parent_flag' => 'doctor.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'doctor.destroy',
        'parent_flag' => 'doctor.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'doctor.create-form',
        'parent_flag' => 'doctor.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'doctor.edit-form',
        'parent_flag' => 'doctor.index',
    ],
];
