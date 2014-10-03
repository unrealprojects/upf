<?php
namespace UpfSeeds;
/*** Add Meta Default***/
class FieldsSeeder extends \Seeder {
	public function run()
	{
        /*** Extended functionality***/
        $Data = [
            /*** Section Users ***/
                /*** List ***/
                ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', 'section_users', 'list'],
                ['Имя', 'first_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'list'],
                ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'list'],
                ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', 'section_users', 'list'],

                /*** Add ***/
                ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
                ['Название', 'title', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
                ['Имя', 'first_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
                ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'add'],
                ['Пароль', 'password', 'password', 'Custom', 'main', true, 'backend', 'section_users', 'add'],

                /*** Edit ***/
                // Group :: Main
                ['№', 'id', 'text', 'Title', 'main', false, 'backend', 'section_users', 'edit'],
                ['Логин', 'login', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],
                ['Пароль', 'password', 'password', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['Название', 'title', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],
                ['Имя', 'first_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],
                ['Фамилия', 'last_name', 'text', 'Title', 'main', true, 'backend', 'section_users', 'edit'],

                ['Email', 'email', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['Телефоны', 'phones', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['Адрес', 'address', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['Веб сайт', 'website', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['Skype', 'skype', 'text', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['О пользователе', 'about', 'textarea', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],
                ['Статус', 'user_status', 'textarea', 'Custom', 'main', true, 'backend', 'section_users', 'edit'],

                // Group :: Media
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', 'section_users', 'edit',''],
                ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', 'section_users', 'edit'],

            /*********************************************************************************************************** For TechOnline ***/
            /*** Section Rent ***/
                /*** Add ***/
                ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', 'section_rent', 'add'],
                /*** Edit ***/
                // Group :: Main
                ['Цена', 'price', 'text', 'Title', 'main', false, 'backend', 'section_rent', 'edit'],
                ['Качество', 'condition', 'text', 'Title', 'main', true, 'backend', 'section_rent', 'edit','config','models/Fields.condition'],
                ['Модель', 'model_id', 'text', 'Title', 'main', true, 'backend', 'section_rent', 'edit', 'model', 'Catalog'],

            /*** Section Parts ***/
                /*** Add ***/
                ['Цена', 'price', 'text', 'Title', 'main', true, 'backend', 'section_parts', 'add'],
                /*** Edit ***/
                // Group :: Main
                ['Цена', 'price', 'text', 'Title', 'main', false, 'backend', 'section_parts', 'edit'],
                ['Качество', 'condition', 'text', 'Title', 'main', true, 'backend', 'section_parts', 'config','models/Fields.condition'],
            /*********************************************************************************************************** End For TechOnline ***/
        ];
        $this->Add($Data);

        /*** Add Default Section Functionality ***/
        $SectionsTables = [
            'section_articles',
            'section_pages',
            'section_catalog',
            'section_rent',
            'section_parts'
        ];
        foreach($SectionsTables as $Table){
            $this->Add($this->DefaultSectionFunctionality($Table));
            $this->Add($this->MetaFieldsDefault($Table));
        }

        $this->Add($this->MetaFieldsDefault('section_users'));

	}

    /*** Insert Default Section Functionality ***/

    public function DefaultSectionFunctionality($Table){
        return [
            /*** List ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'list'],
            ['Введение', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'list'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', $Table, 'list'],

            /*** Add ***/
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'add'],
            ['Введение', 'intro', 'text', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'add'],
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'add',''],

            /*** Edit ***/
            // Group :: Main
            ['№', 'id', 'text', 'Title', 'main', false, 'backend', $Table, 'edit'],
            ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', $Table, 'edit'],
            ['Введение', 'intro', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],
            ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'backend', $Table, 'edit'],

            // Group :: Media
            ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', $Table, 'edit',''],
            ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', $Table, 'edit'],
        ];
    }

    /*** Insert Meta Default (Sections) ***/

    public function MetaFieldsDefault($Table){
        return [
            // Group :: Date
            ['Создано', 'meta-created_at', 'text', 'Date', 'date', true, 'backend', $Table, 'edit'],
            ['Обновлено', 'meta-updated_at', 'text', 'Date', 'date', true, 'backend', $Table, 'edit'],
            // Group :: Meta
            ['Алиас', 'meta-alias', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Title', 'meta-title', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Descriptions', 'meta-description', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
            ['Keywords', 'meta-keywords', 'text', 'Meta', 'meta', true, 'backend', $Table, 'edit'],
             // Group :: Relations
            ['Категория', 'meta-category_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Categories'],
            ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Regions'],
            ['Тэги', 'meta-tags', 'multi-select', 'Relation', 'relations', true, 'backend', $Table, 'edit','model','Tags'],
             // Group :: Statuses
            ['Статус', 'meta-status', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.status'],
            ['Привелегии', 'meta-privileges', 'select', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.privileges'],
            ['Избранное', 'meta-favorite', 'radio', 'Status', 'statuses', true, 'backend', $Table, 'edit','config','models/Fields.favorite'],
            ['Рейтинг', 'meta-rating', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit'],
            ['Просмотры', 'meta-views', 'text', 'Status', 'statuses', false, 'backend', $Table, 'edit']
        ];
    }

    /******************************************************************************************************************* Add ***/

    public function Add($Data){
        foreach($Data as $Field){
            /*** Get Model ***/
            $Model = new \UpfModels\Fields();
            /*** Content ***/
            $Model->title = $Field[0];
            $Model->relation = $Field[1];
            $Model->type = $Field[2];
            $Model->class = $Field[3];
            $Model->group = $Field[4];
            $Model->editable = $Field[5];
            /*** Relations ***/
            $Model->destination = $Field[6];
            $Model->table = $Field[7];
            $Model->view = $Field[8];
            /*** Values ***/
            if(isset($Field[9]) && isset($Field[10])){
                $Model->values_type = $Field[9];
                $Model->values =  $Field[10];
            }
            /*** Save Item ***/
            $Model->save();
        }
    }

}
