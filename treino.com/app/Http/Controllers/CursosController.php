<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Corcel\Model\Page;
use App\Models\linkWP\Posts;



class CursosController extends Controller
{
  public function index(){

    $cursos = $this->getCursos();

    return view('cursos.principal')->with('cursos', $cursos);
  }

  private function getCursos(){
    $unformattedCursos = Page::status('publish')->get();
    $formatCursos = [];

    foreach ($unformattedCursos as $item){

      $hijo = Posts::where('post_parent',$item->ID)
                    ->where('post_type','attachment')
                    ->orderBy('post_date','desc')
                    ->first();

      $one = array(
        'id' => $item->slug,
        'titulo' => $item->title,
        'imagen' => env('WP_SITE').$hijo->guid,
        //'contenido' => $contentCurso,
      );

      $formatCursos = \array_add($formatCursos, $item->slug, $one);
    }

    return $formatCursos;
  }

  public function getInfoCurso(Request $request){
    // formateo el array del contenido del curso: quedando de esta forma:
    /***
    "contenido" => array:3 [
      "Datos Clave" => array:4 [
        "Comienzo" => "val"
        "Dias" => "val"
        "Duración" => "val"
        "Horario" => "val"
      ]
      "Info del curso" => array:3 [
        "Dirigido" => "[val,separados,por,coma]"
        "Condiciones" => "[val,separador,por,coma]"
        "Descripcion" => "[dsc]"
      ]
      "Costo" => "3300"
    ]
    ***/

    $valor = Page::slug($request->curso)->first()->content;
    $unformatCurso = explode("\r\n",$valor);

    if (count($unformatCurso) > 1){
      $contentCurso = [];
      foreach ($unformatCurso as $list){
        if (!empty($list)){
          $key = substr($list,0,strpos($list,'['));
          $value = substr(substr($list,strpos($list,'[')+1, strlen($list)),0,-1);

          $subArray = explode(";",$value);
          $valor =[];
          foreach($subArray as $sublist){
            if (!empty(strpos($sublist,'='))){
              $claveVal = substr($sublist, 0, strpos($sublist,'='));
              $valorVal = substr($sublist, strpos($sublist,'=')+1, strlen($sublist));

              $valor = \array_add($valor, $claveVal, $valorVal);
            }else{
              $valor = $sublist;
            }
          }
          $contentCurso = \array_add($contentCurso, $key, $valor);
        }
      }
    } else{
      $contentCurso = $valor;

    }

    $jsonCurso = json_encode($contentCurso);

    return response()->json([
    'resultado' => $jsonCurso
    ]);
  }
}
