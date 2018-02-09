<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
  public function index(){
    $data =  "Pagina de blog.";
    return view('blog.principal')->with('data', $data);
  }
}
