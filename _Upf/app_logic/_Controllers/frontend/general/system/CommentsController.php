<?php
namespace UpfFrontendControllers;

class CommentsController extends SystemController{

    public function Add(){
       $ReCaptcha = new \Greggilbert\Recaptcha\CheckRecaptcha();
        $Post = new \UpfModels\Comments();

        if(/*$ReCaptcha->check(\Input::get('Challenge'),\Input::get('Response'))[0]=='true' && */$Post =  $Post->Add()){

            $this->ViewData['Comment'] = $Post;


            $Post_View =  \View::make('frontend.techonline.layouts.Snippet.Comments.Item',$this->ViewData);

            echo json_encode(['Message'=>'Спасибо, Ваш комментрий добавлен!','Type'=>'Success',
                              'Post'=>htmlentities($Post_View)
            ]);
       }
       else{

           echo json_encode(['Message'=>'Не верно введена капча!','Type'=>'Error']);
       }
    }
}
