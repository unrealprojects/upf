<?php

/*** Add Routes for Sections:
 *   /.../section/.../
 *   /.../section/.../{alias}/edit
 *   /.../section/.../{alias}/update
 *   /.../section/.../{alias}/remove
 *   /.../section/.../add
 ***/
function NewRoutesGroup($Groups,$SectionType='section',$Division='backend'){
    // Transform Array or String
    if(!is_array($Groups)){
        $temp[] = $Groups;
        $Groups=$temp;
    }

    // First Letter of Division
    $NamespaceDivision=\UpfHelpers\String::LetterToUppercase($Division);

    // Create Routes
    foreach($Groups as $Section){
        // First Letter of Section
        $Controller=\UpfHelpers\String::LetterToUppercase($Section);

        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/','\UpfControllers\\'.$Controller.'Controller@index');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/edit','\UpfControllers\\'.$Controller.'Controller@edit');
        Route::post('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/update','\UpfControllers\\'.$Controller.'Controller@update');
        Route::post('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/updatePhotos','\UpfControllers\\'.$Controller.'Controller@updatePhotos');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/remove','\UpfControllers\\'.$Controller.'Controller@remove');
        Route::any('/' . $Division . '/'.$SectionType.'/' . $Section . '/add','\UpfControllers\\'.$Controller.'Controller@add');

        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/trash','\UpfControllers\\'.$Controller.'Controller@trash');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/draft','\UpfControllers\\'.$Controller.'Controller@draft');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/active','\UpfControllers\\'.$Controller.'Controller@active');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/inactive','\UpfControllers\\'.$Controller.'Controller@inactive');

        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/toFavorite','\UpfControllers\\'.$Controller.'Controller@toFavorite');
        Route::get('/' . $Division . '/'.$SectionType.'/' . $Section . '/{alias}/fromFavorite','\UpfControllers\\'.$Controller.'Controller@fromFavorite');
    }
}