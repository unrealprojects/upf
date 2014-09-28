<?php
return [
    /*** Default ***/
    'status' => [
        0 => 'Inactive',
        1 => 'Active',
        2 => 'Draft',
        3 => 'Trash',
        'default' => 2
    ],
    'privileges' =>[
        0 => 'No Privileges',
        1 => 'Popular',
        2 => 'New',
        3 => 'Bronze',
        4 => 'Silver',
        5 => 'Gold',
        'default' => 0
    ],
    /***  Filter Region ***/
    'administrative_unit' => [
        0 => 'Country',
        1 => 'Region',
        2 => 'City',
        'default' => 2
    ],
    'region_type' => [
        0 => 'Regions',
        1 => 'Republic',
        'default' => 0
    ],
    /*** Filter Params***/
    'param_type' => [
        0 => 'Slider',
        1 => 'Checkbox',
        2 => 'Radio',
        3 => 'Select',
        4 => 'MultSelect'
    ]
];
