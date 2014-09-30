<?php
namespace UpfSeeds;
/*** Add Meta Default***/
class ComponentsSeeder extends \Seeder {
    public $Model = '\UpfModels\Components';
	public function run()
	{
        foreach(\Config::get('models/Components') as $Destinations){
            /*** Write Destinations ***/
            $Model = new $this->Model();
            /*** Content ***/
            $Model->alias = $Destinations['alias'];
            $Model->title = $Destinations['title'];
            $Model->description = $Destinations['description'];
            /*** Status ***/
            $Model->status = \Config::get('models/Fields.status.active');
            $Model->save();

            /*** Write Components ***/
            foreach($Destinations['components'] as $Components){
                /*** Content ***/
                $Model = new $this->Model();
                $Model->alias = $Components['alias'];
                $Model->title = $Components['title'];
                $Model->description = $Components['description'];
                $Model->destination = $Destinations['alias'];
                /*** Status ***/
                $Model->status = \Config::get('models/Fields.status.active');
                $Model->save();
            }
        }
	}

}
