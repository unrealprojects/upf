<?php

namespace UpfModels;

class General extends \Eloquent {
    public $Filter = [];
    public $Destination = 'backend';

    /*** Relation Meta ***/
    public function Meta()
    {
        return $this->hasOne('UpfModels\Meta','id','meta_id');
    }

    /*** Relation Comments ***/
    public function Comments()
    {
        return $this->hasMany('UpfModels\Comments','wall_id','comments_id');
    }


    /*** Create Unique Alias ***/
    public static function CreateUniqueAlias($Alias,$Model,$AliasFiled = 'alias'){
        if($Model::where($AliasFiled,$Alias)->first()){
            $Alias = $Alias . 'D';
            return General::CreateUniqueAlias($Alias,$Model,$AliasFiled);
        }else{
            return $Alias;
        }
    }

    public static function isUniqueAlias($Alias,$Model,$AliasFiled='alias'){
        if($Model::where($AliasFiled,$Alias)->first()){
            return false;
        }else{
            return true;
        }
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Vote Up
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function Vote($Data, $HasMeta = true , $SearchField = false){

    if($Data['direct']=='up')
    {
        $Change = 1;
    }
    elseif($Data['direct']=='down')
    {
        $Change = - 1;
    }

    // Get Item
    if($Data['action'] == 'comments')
    {
        $Item = $this->find($Data['comment_id']);

        if(!\UpfModels\Voted::HasVoted($Data['section'],$Item->id))
        {
            $Rating = $Item->rating = $Item->rating + $Change;
            \UpfModels\Voted::Ban($Data['section'],$Item->id);
        }
        else{
            return false;
        }
    }
    else{
        $Item = $this->GetItemByField($Data['alias'], $HasMeta, $SearchField, $this);

        if(!\UpfModels\Voted::HasVoted($Data['section'],$Item->id))
        {
            $Rating = $Item['meta']['rating'] + $Change;
            $Item->meta()->update([
                'rating' => $Rating
            ]);
            \UpfModels\Voted::Ban($Data['section'],$Item->id);
        }
        else
        {
            return false;
        }
    }

    if($Item->save())
    {
        return $Rating;
    }
    else
    {
        return false;
    }

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
