<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\post;

class WelcomeController extends Controller
{
   public function index(){
       return view('welcome',[
        'posts' => post::all()
       ]);
   }
}
