<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubType extends Model
{
    protected $table = 'subtype';
    protected $fillable = [
        'stype_name',
    ];
    public function poke()
    {
        return $this->belongsTo('App\Pokemon');
    }
}
