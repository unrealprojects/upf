<?php

namespace UpfModels;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    public $timestamps = false;
	protected $table = 'section_users';
	protected $hidden = array('password', 'remember_token');

    /* Связи */
    public function region()
    {
        return $this->hasOne('UpfModels\CatalogRegion','id','region_id');
    }

    public function techList(){
        return $this->hasMany('UpfModels\CatalogTech','admin_id','id');
    }

    public function partsList(){
        return $this->hasMany('UpfModels\CatalogParts','admin_id','id');
    }

    /*** Queries ***/
    public function getList($filter){
        $this->filter = $filter;

        return $this->with('region','metadata')
            ->whereHas('region', function($query) {
                if($this->filter['region']){
                    $query->where('alias', $this->filter['region']);
                }
            })
            ->where('active','=',1)
            ->paginate(5);
    }

    public function getItem($alias){
        $this->rewrite['alias']=$alias;

        return $this->with('region','partsList','partsList.metadata','techList','techList.metadata','comments','metadata')
            ->whereHas('metadata', function($query) {
                $query->where('alias',$this->rewrite['alias']);
            })
            ->first();
    }

    public function getFullItem($alias){
        $this->rewrite['alias']=$alias;

        return $this->with('region',
            'partsList','partsList.metadata',
            'techList','techList.metadata','techList.region','techList.status','techList.opacity','techList.model','techList.model.category','techList.model.brand',
            'comments','metadata')
            ->whereHas('metadata', function($query) {
                $query->where('alias',$this->rewrite['alias']);
            })
            ->first();
    }
}
