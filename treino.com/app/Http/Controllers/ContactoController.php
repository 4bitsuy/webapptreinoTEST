<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

class ContactoController extends Controller
{
  public function index(){
    $data =  "Pagina de contacto.";
    return view('contacto.principal')->with('data', $data);
  }

  protected $correo = 'info@treino.com.uy';

  public function enviarCorreo(Request $request){

    $this->validate($request, [
      'email'    => 'required|email',
      'telefono' => 'required',
      'mensaje'  => 'required|min:10'
    ]);

    $data = array(
      'email'       => $request->email,
      'telefono'    => $request->telefono,
      'nombre'      => $request->nombre,
      'bodyMensaje' => $request->mensaje
    );

    Mail::send('contacto.email', $data, function($message) use($data){
      $message->from($data['email']);
      $message->to($this->correo);
      $message->subject('[WEB] Nuevo mensaje!');
    });

    return redirect('/')->with('status', ['mail' => 'Mensaje enviado! Nos pondremos en contacto']);
  }

  public function enviarCorreoInscripcion(Request $request){

    $this->validate($request, [
      'email'    => 'required|email',
      'telefono' => 'required',
      'mensaje'  => 'required|min:10',
      'curso'    => 'required'
    ]);

    $data = array(
      'email'       => $request->email,
      'telefono'    => $request->telefono,
      'nombre'      => $request->nombre,
      'curso'       => $request->curso,
      'bodyMensaje' => $request->mensaje
    );

    Mail::send('contacto.email-inscripcion', $data, function($message) use($data){
      $message->from($data['email']);
      $message->to($this->correo);
      $message->subject('[WEB] Nueva inscripción a '.$data['curso'].'!');
    });

    return redirect('/')->with('status', ['mail' => 'Mensaje enviado! Nos pondremos en contacto']);
  }

  public function enviarCorreoCurso(Request $request){

    $this->validate($request, [
      'email'    => 'required|email',
      'telefono' => 'required',
      'mensaje'  => 'required|min:10',
      'curso'    => 'required'
    ]);

    $data = array(
      'email'       => $request->email,
      'telefono'    => $request->telefono,
      'nombre'      => $request->nombre,
      'curso'       => $request->curso,
      'bodyMensaje' => $request->mensaje
    );

    Mail::send('contacto.email-cursos', $data, function($message) use($data){
      $message->from($data['email']);
      $message->to($this->correo);
      $message->subject('[WEB] Nueva consulta para '.$data['curso'].'!');
    });

    return redirect('cursos')->with('status', ['mail' => 'Mensaje enviado! Nos pondremos en contacto']);
  }

}
