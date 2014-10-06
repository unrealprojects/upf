<?php

namespace UpfModels;

/*** Params Values***/
class ParamsValues extends Fields {
    public $timestamps = true;
    protected $table = 'params_values';

    public function paramData()
    {
        return $this->hasOne('UpfModels\Params','id','param_id');
    }
}
