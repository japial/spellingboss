<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spellit extends Model
{
    protected $fillable = [
        'word', 'definition', 'bangla', 'sentence', 'type'
    ];
    
    public function spelluser()
    {
        return $this->hasMany('App\Spelluser');
    }
}
