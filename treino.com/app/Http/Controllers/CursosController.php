<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursosController extends Controller
{
  public function index(){
    $data =  "Pagina de cursos.";
    return view('cursos.principal')->with('data', $data);
  }
}
