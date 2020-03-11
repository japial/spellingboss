<?php

namespace App\Http\Controllers;

use App\Spellit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpellitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Spellit::select('id', 'word', 'definition', 'bangla', 'sentence', 'type')->get();
        return  response($words);
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
        $word = $request->all();
        return response($this->create($word));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spellit  $spellit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spellit $spellit)
    {
        if($spellit->word != $request->word){
            $this->validator($request->all())->validate();
            $spellit->word = $request->word;
        }
        $spellit->definition = $request->definition;
        $spellit->bangla = $request->bangla;
        $spellit->sentence = $request->sentence;
        $spellit->type = $request->type;
        $spellit->save();
        $words = Spellit::select('id', 'word', 'definition', 'bangla', 'sentence', 'type')->get();
        return  response($words);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spellit  $spellit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spellit $spellit)
    {
        $spellit->delete();
        $words = Spellit::select('id', 'word', 'definition', 'bangla', 'sentence', 'type')->get();
        return  response($words);
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
            'word' => ['required', 'string', 'max:255', 'unique:spellits'],
            'definition' => ['required', 'string', 'max:255'],
            'bangla' => ['required', 'string', 'max:255'],
            'sentence' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
        ]);
    }
    
      /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Spellit
     */
    protected function create(array $data)
    {
        return Spellit::create([
            'word' => $data['word'],
            'definition' => $data['definition'],
            'bangla' => $data['bangla'],
            'sentence' => $data['sentence'],
            'type' => $data['type']
        ]);
    }

}
