<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;
use App\post;
use App\category;
class DashbordController extends Controller
{
    public function index(){
        return view('dashboard.index',[
            'posts_count'          => post::all()->count() ,
            'Users_count'          => User::all()->count(),
            'category_count'       => category::all()->count()
        ]);
    }

}
