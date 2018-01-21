<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscuelaController extends Controller
{
  public function index(){
      $data =  "Pagina de la escuela.";
      return view('escuela.principal')->with('data', $data);
  }
}
