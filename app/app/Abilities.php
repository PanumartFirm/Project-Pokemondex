<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    protected $table = 'abilities';
    protected $fillable = [
        'abi_name', 'abi_effect',
    ];
    public function poke()
    {
        return $this->belongsTo('App\Pokemon');
    }
}
