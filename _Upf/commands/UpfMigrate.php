<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpfMigrate extends Command {

	protected $name = 'upf:migrate';
	protected $description = 'Migrate All Colons.';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
        /*** Execute All Migrations***/
        foreach(File::allFiles(app_path().'/app_logic/__Database/migrations') as $Migration){
            $FileName = '\UpfMigrations\\'.str_replace('.php','',$Migration->getFilename());
            ${$FileName} = new $FileName;

            ${$FileName}->down();
            ${$FileName}->up();
        }

        /*** Execute All Migrations ***/
        foreach(File::allFiles(app_path().'/app_logic/__Database/seeds') as $Seeder){
            $FileName = '\UpfSeeds\\'.str_replace('.php','',$Seeder->getFilename());
            ${$FileName} = new $FileName;

            ${$FileName}->run();
        }
	}
}
