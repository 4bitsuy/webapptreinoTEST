<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
  public function index(){
    $data =  "Pagina de contacto.";
    return view('contacto.principal')->with('data', $data);
  }
}
