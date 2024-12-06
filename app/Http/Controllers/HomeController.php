<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index(){
        return view('home.index');
    }

    public function index_content(){
        return view('home.index_content');
    }
}
