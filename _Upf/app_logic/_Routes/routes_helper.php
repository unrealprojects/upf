<?php

/*** Add Routes For Backend Sections ***/

    function BackendRoutes($Groups,$SectionType='section',$Division='/backend/'){
        foreach($Groups as $Section){
            $Controller=\UpfHelpers\String::LetterToUppercase($Section);

            /*** Default Events ***/
            Route::get($Division . $SectionType.'/' . $Section .    '/','\UpfControllers\\'.$Controller.'Controller@index');

            Route::any($Division . $SectionType.'/' . $Section .    '/add',                             '\UpfControllers\\'.$Controller.'Controller@add');
            Route::get($Division . $SectionType.'/' . $Section .    '/{alias}/edit',                    '\UpfControllers\\'.$Controller.'Controller@edit');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/update',                  '\UpfControllers\\'.$Controller.'Controller@update');
            Route::get($Division . $SectionType.'/' . $Section .    '/{alias}/remove',                  '\UpfControllers\\'.$Controller.'Controller@remove');


            /*** Files Ajax Events ***/
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/updatePhotos',            '\UpfControllers\\'.$Controller.'Controller@updatePhotos');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/removePhotos/{id}',       '\UpfControllers\\'.$Controller.'Controller@removePhotos');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/removeLogotype/',         '\UpfControllers\\'.$Controller.'Controller@removeLogotype');


            /*** Files Ajax Events ***/
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/trash',                   '\UpfControllers\\'.$Controller.'Controller@trash');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/draft',                   '\UpfControllers\\'.$Controller.'Controller@draft');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/active',                  '\UpfControllers\\'.$Controller.'Controller@active');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/inactive',                '\UpfControllers\\'.$Controller.'Controller@inactive');

            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/toFavorite',              '\UpfControllers\\'.$Controller.'Controller@toFavorite');
            Route::any($Division . $SectionType.'/' . $Section .    '/{alias}/fromFavorite',            '\UpfControllers\\'.$Controller.'Controller@fromFavorite');
        }
    }




/*** *** Add Frontend Default *** ***/

    function FrontendRoutes($Groups){

        foreach($Groups as $Section){
            $Controller=\UpfHelpers\String::LetterToUppercase($Section);
            Route::get('/'. $Section .'/','\UpfFrontendControllers\\'.$Controller.'Controller@Index');
            Route::get('/'. $Section .'/{alias}','\UpfFrontendControllers\\'.$Controller.'Controller@Item');
        }

    }

/*** *** Add Frontend Cabinet *** ***/

    function FrontendCabinetRoutes($Groups){
        foreach($Groups as $Section){
            $Controller=\UpfHelpers\String::LetterToUppercase($Section);

            /*** Cabinet ***/

                Route::get('/'. $Section .'/','\UpfFrontendControllers\\'.$Controller.'Controller@Index');

                Route::any('/' . $Section . '/update',                     '\UpfFrontendControllers\\'     .$Controller.    'Controller@Update');
                Route::any('/' . $Section . '/remove',                     '\UpfFrontendControllers\\'     .$Controller.    'Controller@Remove');

                Route::any('/' . $Section . '/{alias}/photos',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@UpdatePhotos');
                Route::any('/' . $Section . '/{alias}/removePhotos/{id}',  '\UpfFrontendControllers\\'     .$Controller.    'Controller@RemovePhotos');
                Route::any('/' . $Section . '/{alias}/removeLogotype',     '\UpfFrontendControllers\\'     .$Controller.    'Controller@RemoveLogotype');


            /*** Cabinet Rent ***/

                Route::get('/' . $Section . '/rent',                            '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentIndex');

                Route::any('/' . $Section . '/rent/add',                        '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentAdd');
                Route::any('/' . $Section . '/rent/{alias}/edit',               '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentEdit');
                Route::any('/' . $Section . '/rent/{alias}/update',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentUpdate');
                Route::any('' .  $Section . '/rent/{alias}/remove',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentRemove');

                Route::any('/' . $Section . '/rent/{alias}/photos',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentUpdatePhotos');
                Route::any('/' . $Section . '/rent/{alias}/removePhotos/{id}',  '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentRemovePhotos');
                Route::any('/' . $Section . '/rent/{alias}/removeLogotype',     '\UpfFrontendControllers\\'     .$Controller.    'Controller@RentRemoveLogotype');




            /*** Cabinet Parts ***/
                Route::get('/' . $Section . '/parts',                            '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsIndex');

                Route::any('/' . $Section . '/parts/add',                        '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsAdd');
                Route::any('/' . $Section . '/parts/{alias}/edit',               '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsEdit');
                Route::any('/' . $Section . '/parts/{alias}/update',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsUpdate');
                Route::any('' .  $Section . '/parts/{alias}/remove',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsRemove');

                Route::any('/' . $Section . '/parts/{alias}/photos',             '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsUpdatePhotos');
                Route::any('/' . $Section . '/parts/{alias}/removePhotos/{id}',  '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsRemovePhotos');
                Route::any('/' . $Section . '/parts/{alias}/removeLogotype',     '\UpfFrontendControllers\\'     .$Controller.    'Controller@PartsRemoveLogotype');

        }
    }