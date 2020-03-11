<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
{
    
    /**
     * Display words manage page.
     *
     */
    public function index()
    {
        $user = Auth::user();
        if($user->user_type == 'admin'){
           return view('admin.words.index');
        }
        return redirect('home');
    }
    
    /**
     * Display spell it page.
     *
     */
    public function spellitWords()
    {
        $user = Auth::user();
        if($user->user_type == 'admin'){
           return view('admin.words.spellit');
        }
        return redirect('home');
    }
    
}
