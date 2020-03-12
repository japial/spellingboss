<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Round;
use App\Spellit;
use App\Spelluser;
use App\Spellword;

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
    public function spellitUsers() {
        return view('admin.game.spellusers');
    }
    
    /**
     * Display a spell it game page.
     *
     */
    public function spellitGame($id) {
        $data['spelluser'] = $id;
        return view('admin.game.spellit', $data);
    }
    
    /**
     * return a spell it All info.
     *
     */
    public function spellUserInfo() {
        $data['spellers'] = User::select('id', 'name')->where('user_type', 'speller')->get();
        $data['rounds'] = Round::select('id', 'name')->get();
        $data['words'] = Spellit::select('id', 'word')->get();
        return  response($data);
    }
    
    /**
     * return a spell it game info.
     *
     */
    public function spellitGameInfo($id) {
        $speller = Spelluser::find($id);
        $data['speller'] = $speller->user->name;
        $data['round'] = $speller->round->name;
        $spellwords = Spellword::where('spelluser_id', $speller->id)->get();
        $words = array();
        foreach ($spellwords as $value) {
            $words[] = $value->spellit;
        }
        $data['words'] = $words;
        return  response($data);
    }
}
