<?php

namespace UpfModels;

class Comments extends Fields {
    public $timestamps = true;
    protected $table = 'system_comments';

    public function Add(){

        $this->author =     \Input::get('Author');
        $this->post =       \Input::get('Post');
        $this->alias =      $this->CreateUniqueAlias(\Mascame\Urlify::filter(substr($this->post,0,20)),'\UpfModels\\Comments');
        $this->wall_id = \Input::get('Wall-Id');
        $this->save();
        return $this->toArray();
    }
}
