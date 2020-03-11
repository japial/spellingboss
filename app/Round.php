<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = [
        'name', 'finished'
    ];
    
    public function spelluser()
    {
        return $this->hasMany('App\Spelluser');
    }
}
