<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $fillable = [
        'user_id', 'poke_no',
    ];
    public function fuser(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function fpoke(){
        return $this->hasOne('App\Pokemon', 'id', 'poke_no');
    }
}
