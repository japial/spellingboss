<?php

namespace App\Http\Controllers;

use App\Spelluser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SpelluserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spellusers = Spelluser::all();
        return  response($spellusers);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        Spelluser::create([
            'user_id' => $request->user,
            'round_id' => $request->round,
            'spellit_id' => $request->word
        ]);
        $spellusers = Spelluser::all();
        return  response($spellusers);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spelluser  $spelluser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spelluser $spelluser)
    {
        $this->validator($request->all())->validate();
        $spelluser->user_id = $request->user;
        $spelluser->round_id = $request->round;
        $spelluser->spellit_id = $request->word;
        $spelluser->collect = $request->collect;
        $spelluser->save();
        $spellusers = Spelluser::all();
        return  response($spellusers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spelluser  $spelluser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spelluser $spelluser)
    {
        $spelluser->delete();
        $spellusers = Spelluser::all();
        return  response($spellusers);
    }
    
    /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user' => ['required'],
            'round' => ['required'],
            'word' => ['required']
        ]);
    }
}
