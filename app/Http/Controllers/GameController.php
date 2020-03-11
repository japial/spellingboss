<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Round;
use App\Spellit;

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
    
    /**
     * Display a spell it All info.
     *
     */
    public function spellUserInfo() {
        $data['spellers'] = User::select('id', 'name')->where('user_type', 'speller')->get();
        $data['rounds'] = Round::select('id', 'name')->get();
        $data['words'] = Spellit::select('id', 'word')->get();
        return  response($data);
    }
}
