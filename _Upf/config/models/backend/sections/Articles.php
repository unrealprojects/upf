<?php
return [
    'list' =>[
        'title'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['title']
        ],
        'intro'=>[
            'title'=>'Описание',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['intro']
        ],
        'updated_at'=>[
            'title'=>'Дата изменения',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
            'relation' => ['meta','updated_at']
        ]
    ],

    'add' => [
        'title'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['title']
        ],
        'intro'=>[
            'title'=>'Описание',
            'type'=>'textarea',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['intro']
        ],
        'updated_at'=>[
            'title'=>'Дата изменения',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
            'relation' => ['meta','updated_at']
        ]
    ],

    'edit' => [
        'title'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['title']
        ],
        'intro'=>[
            'title'=>'Описание',
            'type'=>'textarea',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['intro']
        ],
        'updated_at'=>[
            'title'=>'Дата изменения',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
            'relation' => ['meta','updated_at']
        ]
    ]
];