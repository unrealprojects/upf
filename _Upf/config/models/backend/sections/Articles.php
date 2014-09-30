<?php
return [
    /*** List ***/
    'list' =>[
        'title'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['title']
        ],
        'intro'=>[
            'title'=>'Введение',
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
    /*** Add ***/
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
        ]
    ],
    /*** Edit ***/
    'edit' => [
        'title'=>[
            'title'=>'Заголовок',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['title']
        ],
        'intro'=>[
            'title'=>'Введение',
            'type'=>'textarea',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['intro']
        ],
        'text'=>[
            'title'=>'Текст',
            'type'=>'textarea',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['text']
        ],
        'logotype'=>[
            'title'=>'Логотип',
            'type'=>'photo',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['logotype']
        ],
        'created_at'=>[
            'title'=>'Дата создания',
            'type'=>'text',
            'class'=>'Date',
            'editable'=>false,
            'relation' => ['meta','created_at']
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