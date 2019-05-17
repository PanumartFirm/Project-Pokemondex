<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $fillable = [
        'type_name',
    ];
    public function poke()
    {
        return $this->belongsTo('App\Pokemon');
    }
}
