<?php
namespace UpfFrontendControllers;

class VoteController extends SystemController{

	public function Vote()
	{
        $Data = [
            'action'    =>      \Input::get('action'),
            'section'    =>      \Input::get('section'),
            'alias'    =>      \Input::get('action'),
            'direct'    =>      \Input::get('action'),
        ];

        if($Data['action']=='section')
        {
            $Model = \UpfHelpers\String::LetterToUppercase($Data['section']);
            $DefaultModel = new $Model();

            $Model->Vote($Data['alias']);

        }
        elseif($Data['action']=='comment'){

        }



/*

        // Проверка ip
        if(!\UpfModels\Voted::hasVoted('comments',$id) &&
            $newVote=\UpfModels\Comments::find($id)){

            $newVoteIp = new \UpfModels\Voted();
            $newVoteIp->app_section=$app_section;
            $newVoteIp->item_id=$id;
            $newVoteIp->ip=\Request::getClientIp();
            $newVoteIp->save();

            $newVote->rating=++$newVote->rating;
            $newVote->save();
            echo json_encode(['Event'=>'Сообщение','Message'=>'Спасибо, Ваш голос учтен!','Type'=>'Success']);
        }else{
            echo json_encode(['Event'=>'Ошибка','Message'=>'Возможно, Вы уже проголосовали!','Type'=>'Error']);
        }*/
	}


}
