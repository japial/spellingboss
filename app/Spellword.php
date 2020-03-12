<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spellword extends Model
{
    protected $fillable = [
        'spelluser_id','spellit_id', 'correct'
    ];
    
    public function spelluser()
    {
        return $this->belongsTo('App\Spelluser');
    }
    
    public function spellit()
    {
        return $this->belongsTo('App\Spellit');
    }
}
