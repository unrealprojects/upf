<?php
namespace UpfSeeds;
/*** Add Meta Default***/
class FieldsSeeder extends \Seeder {
	public function run()
	{
        $Seeds = [
            /*** Sections ***/
            'Articles',
            'Pages',
            'Users',
            /*** Tech Online ***/
            'Catalog',
            'Rent',
            'Parts',
            /*** Filters ***/
            'Categories',
            'Tags',
            'Regions',
            'Params',
            /*** System ***/
            'Administrators',
            'Comments',
            'Components',
            'Fields',
            'Meta'
        ];
        /*** Add Fields Of Migration ***/
        foreach($Seeds as $Seed){
            $Seed = '\UpfMigrations\\' . $Seed;
            $this->Add($Seed::fields());
        }

        $Tables = [
            /*** Sections ***/
            'section_articles',
            'section_pages',
            'section_users',
            /*** Tech Online ***/
            'section_catalog',
            'section_rent',
            'section_parts'
        ];

        /*** Add Fields Meta ***/
        foreach($Tables as $Table){
            $this->Add(\UpfMigrations\Meta::MetaFields($Table));
        }
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
