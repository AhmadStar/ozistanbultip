<?php

return [
    [
        'name' => 'Offers',
        'flag' => 'offers.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'offers.create',
        'parent_flag' => 'offers.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'offers.edit',
        'parent_flag' => 'offers.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'offers.destroy',
        'parent_flag' => 'offers.index',
    ],
];
