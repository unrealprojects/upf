<?php

/*** Add Routes for Sections:
 *   /.../section/.../
 *   /.../section/.../{alias}/edit
 *   /.../section/.../{alias}/update
 *   /.../section/.../{alias}/remove
 *   /.../section/.../add
 ***/
function NewRoutesGroup($Groups,
                         $SiteName='General',
                         $SectionType='section',
                         $Division='backend'){
    // Transform Array or String
    if(!is_array($Groups)){
        $temp[] = $Groups;
        $Groups=$temp;
    }

    // First Letter of Division
    $NamespaceDivision=\UpfHelpers\String::LetterToUppercase($Division);
    // Add Namespace Slash
    $SiteName= $SiteName.'\\';

    // Create Routes
    foreach($Groups as $Section){
        // First Letter of Section
        $Controller=\UpfHelpers\String::LetterToUppercase($Section);

        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/','\Controller\\'.$NamespaceDivision.'\\'.$SiteName.$Controller.'Controller@index');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/edit','\Controller\\'.$NamespaceDivision.'\\'.$SiteName.$Controller.'Controller@edit');
        Route::post('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/update','\Controller\\'.$NamespaceDivision.'\\'.$SiteName.$Controller.'Controller@update');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/remove','\Controller\\'.$NamespaceDivision.'\\'.$SiteName.$Controller.'Controller@remove');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/add','\Controller\\'.$Division.'\\'.$SiteName.$Controller.'Controller@add');
    }
}