<?php
return [
    /*** Sections ***/
    'sections' =>[
        'alias' =>'section',
        'title' => 'Разделы',
        'description' => 'Основные разделы сайта.',
        'components'=>[
            'articles' => [
                'alias' => 'articles',
                'title' => 'Статьи',
                'description' => 'Компонент для размещения статей.',
            ],
            'pages' => [
                'alias' => 'pages',
                'title' => 'Страницы',
                'description' => 'Компонент для создания статических страниц.',
            ],
            'users' => [
                'alias' => 'users',
                'title' => 'Пользователи',
                'description' => 'Компонент пользователей.',
            ],
            /*** Techonline ***/
            'catalog' => [
                'alias' => 'catalog',
                'title' => 'Каталог',
                'description' => 'Компонент для создания каталога.',
            ],
            'rent' => [
                'alias' => 'rent',
                'title' => 'Аренда',
                'description' => 'Компонент аренды стройтехники.',
            ],
            'parts' => [
                'alias' => 'parts',
                'title' => 'Запчасти и сервис',
                'description' => 'Компонент запчастей.',
            ],
        ]
    ],

    /*** Filters ***/
    'filters' =>[
        'alias' =>'filter',
        'title' => 'Фильтры',
        'description' => 'Фильтрация в разделах.',
        'components'=>[
            'categories' => [
                'alias' => 'categories',
                'title' => 'Категории',
                'description' => 'Фмльтрация по категориям.',
            ],
            'tags' => [
                'alias' => 'tags',
                'title' => 'Теги',
                'description' => 'Фмльтрация по тегам.',
            ],
            'regions' => [
                'alias' => 'regions',
                'title' => 'Регионы',
                'description' => 'Фмльтрация по регионам.',
            ],
            'params' => [
                'alias' => 'params',
                'title' => 'Параметры',
                'description' => 'Фмльтрация по параметрам.',
            ],
        ]
    ],
    /*** System ***/
    'system' =>[
        'alias' =>'system',
        'title' => 'Система',
        'description' => 'Управление системой сайта',
        'components'=>[
            'administrators' => [
                'alias' => 'administrators',
                'title' => 'Администраторы',
                'description' => 'Документация cms.',
            ],
            'components' => [
                'alias' => 'components',
                'title' => 'Компоненты',
                'description' => 'Компоненты системы.',
            ],

            'comments' => [
                'alias' => 'comments',
                'title' => 'Комментарии',
                'description' => 'Комментарии на сайте.',
            ],
            'meta' => [
                'alias' => 'meta',
                'title' => 'Катра сайта',
                'description' => 'Карта сайта.',
            ],
            'files' => [
                'alias' => 'files',
                'title' => 'Катра сайта',
                'description' => 'Карта сайта.',
            ],
            'settings' => [
                'alias' => 'settings',
                'title' => 'Настройки',
                'description' => 'Настройки.',
            ]
         ]
    ],
    /*** Docs ***/
    'docs' =>[
        'alias' =>'docs',
        'title' => 'Документация',
        'description' => 'Документация по работе с Админкой.',
        'components'=>[
            'cms' => [
                'alias' => 'cms',
                'title' => 'cms',
                'description' => 'Документация cms.',
            ],

            'css' => [
                'alias' => 'css',
                'title' => 'css',
                'description' => 'Документация css.',
            ],

            'js' => [
                'alias' => 'js',
                'title' => 'js',
                'description' => 'Документация js.',
            ],
        ]
    ],



];
