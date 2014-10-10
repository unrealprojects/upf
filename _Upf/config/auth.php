<?php

return array(
/*
	'driver' => 'eloquent',


	'model' => '\UpfModels\Administrators',


	'table' => 'system_administrators',

	'reminder' => array(

		'email' => 'emails.auth.reminder',

		'table' => 'password_reminders',

		'expire' => 60,

	),*/

    'multi' => array(
        'administrators' => array(
            'driver' => 'eloquent',
            'model' => '\UpfModels\Administrators',
            'table' => 'administrators',
        ),
        'users' => array(
            'driver' => 'eloquent',
            'model' => '\UpfModels\Users',
            'table' => 'users'
        )
    ),

    'reminder' => array(

        'email' => 'emails.auth.reminder',

        'table' => 'password_reminders',

        'expire' => 60,

    ),

);
