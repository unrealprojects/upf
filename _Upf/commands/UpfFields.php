<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpfFields extends Command {

	protected $name = 'upf:update_fields';
	protected $description = 'Seeds All Colons.';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
        \UpfModels\Fields::truncate();
        /*** Add Fields***/
        $FieldsSeeder =  new UpfSeeds\FieldsSeeder();
        $FieldsSeeder->run();
	}
}
