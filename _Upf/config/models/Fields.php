<?php
return [
    /*** Default ***/
    'status' => [
        0 => 'Inactive',
        1 => 'Active',
        2 => 'Draft',
        3 => 'Trash',
        'inactive' => 0,
        'active' => 1,
        'default' => 2,
        'trash'=> 3
    ],
    'privileges' => [
        0 => 'No Privileges',
        1 => 'Popular',
        2 => 'New',
        3 => 'Bronze',
        4 => 'Silver',
        5 => 'Gold',
        'default' => 0
    ],
    'favorite' => [
        0 => 'Active',
        1 => 'Inactive'
    ],

    'sections' =>[
        /*** General ***/
        0 => 'articles',
        1 => 'pages',
        2 => 'users',
        /*** Tech Online***/
        3 => 'catalog',
        4 => 'rent',
        5 => 'parts',
    ],
    /*** Component type ***/
    'component_type'=>[
        0 => 'section',
        1 => 'filter',
        2 => 'system'
    ],
    /*** Destination ***/
    'destination'=>[
        0 => 'backend',
        1 => 'frontend'
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
    /*** Filter Params ***/
    'param_type' => [
        0 => 'Slider',
        1 => 'Checkbox',
        2 => 'Radio',
        3 => 'Select',
        4 => 'MultiSelect'
    ],
    /*** Condition ***/
    'condition' => [
        0 => 'Новый',
        1 => 'БУ'
    ],

];
