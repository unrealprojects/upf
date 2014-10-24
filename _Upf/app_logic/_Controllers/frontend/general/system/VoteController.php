<?php
namespace UpfFrontendControllers;

class VoteController extends SystemController{

	public function Vote()
	{
        $Data = [
            'action'        =>      \Input::get('action'),
            'section'       =>      \Input::get('section'),
            'alias'         =>      \Input::get('alias'),
            'direct'        =>      \Input::get('direct'),
            'comment_id'    =>      \Input::get('comment_id')
        ];


        $Model = '\UpfModels\\' . \UpfHelpers\String::LetterToUppercase($Data['section']);
        $DefaultModel = new $Model();


        if($Rating = $DefaultModel->Vote($Data))
        {
            echo json_encode([
                'Type'=>'Success',
                'Message'=>'Спасибо, Ваш голос учтен!',
                'Rating'=>$Rating
            ]);
        }
        else
        {
            echo json_encode([
                'Type'=>'Error',
                'Message'=>'Возможно, Вы уже проголосовали!'
            ]);
        }

	}


}
