<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spelluser extends Model
{
    protected $fillable = [
        'user_id', 'round_id', 'spellit_id', 'correct'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function round()
    {
        return $this->belongsTo('App\Round');
    }
    
    public function spellit()
    {
        return $this->belongsTo('App\Spellit');
    }
}
