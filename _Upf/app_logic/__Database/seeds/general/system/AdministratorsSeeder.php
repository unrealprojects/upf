<?php
namespace UpfSeeds;
/*** Add Meta Default***/
class AdministratorsSeeder extends \Seeder {
    public $Model = '\UpfModels\Administrators';
	public function run()
	{
        $Model = new $this->Model();
        /*** Auth ***/
        $Model->login = 'upf';
        $Model->password = \Hash::make('developer');

        /*** Content***/
        $Model->firstname = 'Unreal';
        $Model->lastname = 'Projects';
        $Model->email = 'office@unrealprojects.com';
        $Model->phones = '+380983159292';

        /*** Status ***/
        $Model->status = \Config::get('models/Fields.status.active');

        $Model->save();
	}

}
