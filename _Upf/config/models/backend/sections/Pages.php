<?php
return [
    'list' =>[
        'title'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
        ],
        'intro'=>[
            'title'=>'Описание',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
        ],
        'updated_at'=>[
            'title'=>'Дата изменения',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
            'relation' => 'meta'
        ]
    ],

    'add' => [
        'name'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
        ],
        'text_preview'=>[
            'title'=>'Описание',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
        ],
        'updated_at'=>[
            'title'=>'Дата изменения',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
        ]
    ],

    'edit' => [
        'name'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
        ],
        'text_preview'=>[
            'title'=>'Описание',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
        ],
        'updated_at'=>[
            'title'=>'Дата изменения',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
        ]
    ]
];