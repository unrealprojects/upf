<?php
namespace Controller;

class VoteController extends \Controller{

	public function up($app_section,$id)
	{
        /* Проверка ip */
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
        }
	}

    public function down($app_section,$id)
    {
        /* Проверка ip */
        if(!\UpfModels\Voted::hasVoted('comments',$id) &&
            $newVote=\UpfModels\Comments::find($id)){

            $newVoteIp = new \UpfModels\Voted();
            $newVoteIp->app_section=$app_section;
            $newVoteIp->item_id=$id;
            $newVoteIp->ip=\Request::getClientIp();
            $newVoteIp->save();

            $newVote->rating=--$newVote->rating;
            $newVote->save();
            echo json_encode(['Event'=>'Сообщение','Message'=>'Спасибо, Ваш голос учтен!','Type'=>'Success']);
        }else{
            echo json_encode(['Event'=>'Ошибка','Message'=>'Возможно, Вы уже проголосовали!','Type'=>'Error']);
        }
    }

}
