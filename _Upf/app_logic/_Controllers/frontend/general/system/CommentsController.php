<?php
namespace Controller;

class CommentsController extends \Controller{
    public $Upf_Page_Section =       'users';


    public function add($list_id){
       $reCaptcha = new \Greggilbert\Recaptcha\CheckRecaptcha();
       if($reCaptcha=$reCaptcha->check(\Input::get('challenge'),\Input::get('response'))[0]=='true'){
           $comment = new \UpfModels\Comments();

           $comment->name = \Input::get('name');
           $comment->comment = \Input::get('comment');
           $comment->list_id = $list_id;
           $comment->save();
           $comment['comment']=$comment->find($comment->id)->toArray();
           $content = \View::make('frontend.standard.layouts.comments.Item',$comment);


           $newVoteIp = new \UpfModels\Voted();
           $newVoteIp->section='comments';
           $newVoteIp->item_id=$comment->id;
           $newVoteIp->ip=\Request::getClientIp();
           $newVoteIp->save();

           echo json_encode(['Message'=>'Спасибо, Ваш комментрий добавлен!','Type'=>'Success',
                             'comment'=>[htmlentities($content)]]);
       }else{
           echo json_encode(['Message'=>'Не верно введена капча!','Type'=>'Error']);
       }
    }
}
