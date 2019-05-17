<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = 'species';
    protected $fillable = [
        'spe_name',
    ];
    public function poke()
    {
        return $this->belongsTo('App\Pokemon');
    }
}
