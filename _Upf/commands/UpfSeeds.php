<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpfSeeds extends Command {

	protected $name = 'upf:seeds';
	protected $description = 'Seeds All Colons.';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
        /*** Execute All Seeds ***/
        foreach(File::allFiles(app_path().'/app_logic/__Database/seeds') as $Seeder){
            $FileName = '\UpfSeeds\\'.str_replace('.php','',$Seeder->getFilename());
            ${$FileName} = new $FileName;

            ${$FileName}->run();
        }
	}
}
