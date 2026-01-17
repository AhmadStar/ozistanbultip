<?php

return [
    [
        'name' => 'Rendevus',
        'flag' => 'rendevu.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'rendevu.create',
        'parent_flag' => 'rendevu.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'rendevu.edit',
        'parent_flag' => 'rendevu.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'rendevu.destroy',
        'parent_flag' => 'rendevu.index',
    ],
];
