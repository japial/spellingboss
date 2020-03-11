<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    
    /**
     * Display a rounds page.
     *
     */
    public function rounds() {
        return view('admin.game.rounds');
    }
    
    /**
     * Display a spell it game page.
     *
     */
    public function spellitGame() {
        return view('admin.game.spellit');
    }
}
