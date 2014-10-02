<?php
namespace UpfSeeds;
/*** Add Meta Default***/
class FieldsSeeder extends \Seeder {
	public function run()
	{
        $Data = [
        /*************************************************************************************************************** Articles *** ***/

            /*** *** Backend *** ***/

                /*** List ***/
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', 'section_articles', 'list'],
                ['Введение', 'intro', 'text', 'Custom', 'main', true, 'backend', 'section_articles', 'list'],
                ['Обновлено', 'meta-updated_at', 'text', 'Date', 'main', true, 'backend', 'section_articles', 'list'],

                /*** Add ***/
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', 'section_articles', 'add'],
                ['Введение', 'intro', 'text', 'Custom', 'main', true, 'backend', 'section_articles', 'add'],
                ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'backend', 'section_articles', 'add'],
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', 'section_articles', 'add',''],

                /*** Edit ***/
                // Group :: Main
                ['№', 'id', 'text', 'Title', 'main', false, 'backend', 'section_articles', 'edit'],
                ['Заголовок', 'title', 'text', 'Title', 'main', true, 'backend', 'section_articles', 'edit'],
                ['Введение', 'intro', 'textarea', 'Custom', 'main', true, 'backend', 'section_articles', 'edit'],
                ['Текст', 'text', 'textarea', 'Custom', 'main', true, 'backend', 'section_articles', 'edit'],

                // Group :: Date
                ['Создано', 'meta-created_at', 'text', 'Date', 'date', true, 'backend', 'section_articles', 'edit'],
                ['Обновлено', 'meta-updated_at', 'text', 'Date', 'date', true, 'backend', 'section_articles', 'edit'],

                // Group :: Media
                ['Логотип', 'logotype', 'photo', 'Photo', 'media', true, 'backend', 'section_articles', 'edit',''],
                ['Галлерея', 'meta-files', 'photos', 'Gallery', 'media', true, 'backend', 'section_articles', 'edit'],

                // Group :: Meta
                ['Алиас', 'meta-alias', 'text', 'Meta', 'meta', true, 'backend', 'section_articles', 'edit'],
                ['Title', 'meta-title', 'text', 'Meta', 'meta', true, 'backend', 'section_articles', 'edit'],
                ['Descriptions', 'meta-description', 'text', 'Meta', 'meta', true, 'backend', 'section_articles', 'edit'],
                ['Keywords', 'meta-keywords', 'text', 'Meta', 'meta', true, 'backend', 'section_articles', 'edit'],

                // Group :: Relations
                ['Категория', 'meta-category_id', 'select', 'Relation', 'relations', true, 'backend', 'section_articles', 'edit','model','Categories'],
                ['Регион', 'meta-region_id', 'select', 'Relation', 'relations', true, 'backend', 'section_articles', 'edit','model','Regions'],
                ['Тэги', 'meta-tags', 'multi-select', 'Relation', 'relations', true, 'backend', 'section_articles', 'edit','model','Tags'],

                // Group :: Statuses
                ['Статус', 'meta-status', 'select', 'Status', 'statuses', true, 'backend', 'section_articles', 'edit','config','models/Fields.status'],
                ['Привелегии', 'meta-privileges', 'select', 'Status', 'statuses', true, 'backend', 'section_articles', 'edit','config','models/Fields.privileges'],
                ['Избранное', 'meta-favorite', 'radio', 'Status', 'statuses', true, 'backend', 'section_articles', 'edit','config','models/Fields.favorite'],
                ['Рейтинг', 'meta-rating', 'text', 'Status', 'statuses', false, 'backend', 'section_articles', 'edit'],
                ['Просмотры', 'meta-views', 'text', 'Status', 'statuses', false, 'backend', 'section_articles', 'edit']




            /*********************************************************************************************************** Frontend ***/
        ];

        /*** Make Insert Data Array***/
        foreach($Data as $Field){
            /*** Content ***/
            $FieldItem['title'] = $Field[0];
            $FieldItem['relation'] = $Field[1];
            $FieldItem['type'] = $Field[2];
            $FieldItem['class'] = $Field[3];
            $FieldItem['group'] = $Field[4];
            $FieldItem['editable'] = $Field[5];
            /*** Relations ***/
            $FieldItem['destination'] = $Field[6];
            $FieldItem['table'] = $Field[7];
            $FieldItem['view'] = $Field[8];

            /*** Values ***/
            if(isset($Field[9]) && isset($Field[10])){
                $FieldItem['values_type'] = $Field[9];
                $FieldItem['values'] = $Field[10];
            }


            $this->Add($FieldItem);
        }
	}


    public function Add($Data){
        /*** Get Model ***/
        $Model = new \UpfModels\Fields();
        /*** Content ***/
        $Model->title = $Data['title'];
        $Model->relation = $Data['relation'];
        $Model->type = $Data['type'];
        $Model->class = $Data['class'];
        $Model->group = $Data['group'];
        $Model->editable = $Data['editable'];
        /*** Relations ***/
        $Model->table = $Data['table'];
        $Model->destination = $Data['destination'];
        $Model->view = $Data['view'];
        /*** Values ***/
        if(isset($Data['values']) && $Data['values_type']){
            $Model->values = $Data['values'];
            $Model->values_type = $Data['values_type'];
        }

        /*** Save Item ***/
        $Model->save();
    }
}
