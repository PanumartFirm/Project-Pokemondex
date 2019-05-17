<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hidden extends Model
{
    protected $table = 'hidden';
    protected $fillable = [
        'hid_name', 'hid_effect',
    ];
    public function poke()
    {
        return $this->belongsTo('App\Pokemon');
    }
}
