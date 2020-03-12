<?php

namespace App\Http\Controllers;

use App\Spelluser;
use App\Spellword;
use App\User;
use App\Round;
use App\Spellit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpelluserController extends Controller {

    public function index() {
        $spellusers = Spelluser::select('id', 'user_id', 'round_id')->get();
        $spellers = $this->getSpellersData($spellusers);
        return response($spellers);
    }

    public function store(Request $request) {
        $words = $request->word;
        if (!empty($words)) {
            $this->validator($request->all())->validate();
            $this->createSpellUserWords($request->user, $request->round, $words);
        }
        $spellusers = Spelluser::select('id', 'user_id', 'round_id')->get();
        $spellers = $this->getSpellersData($spellusers);
        return response($spellers);
    }
   
    public function update(Request $request, Spelluser $spelluser) {
        $this->validator($request->all())->validate();
        $spelluser->user_id = $request->user;
        $spelluser->round_id = $request->round;
        $spelluser->save();
        $words = $request->word;
        $this->deleteSpellUserWords($spelluser->id);
        $this->createSpellWords($spelluser->id, $words);
        $spellusers = Spelluser::select('id', 'user_id', 'round_id')->get();
        $spellers = $this->getSpellersData($spellusers);
        return response($spellers);
    }

    public function destroy(Spelluser $spelluser) {
        $this->deleteSpellUserWords($spelluser->id);
        $spelluser->delete();
        $spellusers = Spelluser::select('id', 'user_id', 'round_id')->get();
        $spellers = $this->getSpellersData($spellusers);
        return response($spellers);
    }
    
    protected function validator(array $data) {
        return Validator::make($data, [
            'user' => ['numeric','min:0','not_in:0'],
            'round' => ['numeric','min:0','not_in:0']
        ]);
    }
    
    private function createSpellUserWords($user, $round, $words) {
        $spellUser = $this->createSpellUser(array(
                        'user' => $user,
                        'round' => $round
                    ));
        $this->createSpellWords($spellUser->id, $words);
    }

    private function createSpellUser($data) {
        return Spelluser::create([
                    'user_id' => $data['user'],
                    'round_id' => $data['round'],
        ]);
    }
    
    private function createSpellWords($suser, $words) {
        foreach ($words as $value) {
            Spellword::create([
                'spelluser_id' => $suser,
                'spellit_id' => $value
            ]);
        }
    }
    
    private function deleteSpellUserWords($suser) {
        $words = Spellword::where('spelluser_id', $suser)->get();
        foreach ($words as $value) {
            $value->delete();
        }
    }

    private function getSpellersData($spellusers) {
        $data = array();
        foreach ($spellusers as $suser) {
            $data[] = array(
                'id' => $suser->id,
                'user_id' => $suser->user_id,
                'round_id' => $suser->round_id,
                'speller' => $suser->user->name,
                'round' => $suser->round->name,
                'words' =>  $this->getSpellWords($suser->id),
                );
        }
        return $data;
    }   
    
    private function getSpellWords($suser) {
        $spellWords = Spellword::where('spelluser_id', $suser)->get();
        $words = array();
        foreach ($spellWords as $value) {
            $words[] = array(
                'correct' => $value->correct,
                'details' => $value->spellit
            );
        }
        return $words;
    }

}
