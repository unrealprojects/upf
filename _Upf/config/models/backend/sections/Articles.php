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
        ],
        /*** Meta ***/
        'meta_title'=>[
            'title'=>'Meta Title',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['meta','title']
        ],
        'meta_description'=>[
            'title'=>'Meta Description',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['meta','description']
        ],
        'meta_keywords'=>[
            'title'=>'Meta Keywords',
            'type'=>'text',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['meta','keywords']
        ],
        'meta_category_id'=>[
            'title'=>'Категория',
            'type'=>'select',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['meta','category_id'],
            'values' =>\UpfModels\Categories::all()
        ],
        'meta_regions_id'=>[
            'title'=>'Регион',
            'type'=>'select',
            'class'=>'Title',
            'editable'=>true,
            'relation' => ['meta','regions_id'],
            'values' =>\UpfModels\Regions::all()
        ]
    ]
];