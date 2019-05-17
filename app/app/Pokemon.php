<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pokemon extends Model
{
    protected $table = 'pokemon';
    protected $fillable = [
        'poke_name', 'poke_content','poke_pic','spe_id',
        'type_id','stype_id','abi_id','hid_id','gender','height','weight',
    ];
    public function fav(){
        return $this->belongsTo('App\Favorite', 'poke_no', 'id');
    }
    public function spe(){
        return $this->hasOne('App\Species', 'id', 'spe_id');
    }
    public function type(){
        return $this->hasOne('App\Type', 'id', 'type_id');
    }
    public function stype(){
        return $this->hasOne('App\SubType', 'id', 'stype_id');
    }
    public function abi(){
        return $this->hasOne('App\Abilities', 'id', 'abi_id');
    }
    public function hid(){
        return $this->hasOne('App\Hidden', 'id', 'hid_id');
    }

}
