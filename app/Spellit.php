<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spellit extends Model
{
     protected $fillable = [
        'word', 'definition', 'bangla', 'sentence', 'type'
    ];
}
