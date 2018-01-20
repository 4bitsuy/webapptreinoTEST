<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Page;

class HomeController extends Controller
{
    public function index(){
        $data =  Page::slug('ejemplo')->first();
        return view('home')->with('data', $data);
    }
}
