<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rounds = Round::select('id', 'name', 'finished')->get();
        return  response($rounds);
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
        $data = $request->all();
        return response($this->create($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Round $round)
    {
        if($round->name != $request->name){
            $this->validator($request->all())->validate();
            $round->name = $request->name;
        }
        $round->finished = $request->finished;
        $round->save();
        $rounds = Round::select('id', 'name', 'finished')->get();
        return  response($rounds);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy(Round $round)
    {
        $round->delete();
        $rounds = Round::select('id', 'name', 'finished')->get();
        return  response($rounds);
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
            'name' => ['required', 'string', 'max:255', 'unique:rounds']
        ]);
    }
    
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Round
     */
    protected function create(array $data)
    {
        return Round::create([
            'name' => $data['name'],
            'finished' => $data['finished']
        ]);
    }
}
