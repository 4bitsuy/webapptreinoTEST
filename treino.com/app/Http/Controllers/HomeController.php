<?php
//rs
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use App\Models\linkWP\Posts;
use App\Models\linkWP\Terms;
use App\Models\linkWP\Taxonomy;
use App\Models\linkWP\RelTaxPosts;
use Corcel\Model\Page;

class HomeController extends Controller
{

    protected $request;

    public function index(){
        // All published posts
        $posts = Post::newest()->status('publish')->get();
        //$posts = Post::status('publish')->get();

        // flag que en un futuro levanta una configuracion para mostrar los cursos...
        $hasCursosCortos = false;

        $homeData = $this->getInfoInicio($posts);
        $staffData = $this->getInfoStaff($posts);
        //$entradas = $this->getLastEntradas($posts);

        $cursosCortos = $this->getCursosCortos();
        $cursos = $this->getCursos();

        $opiniones = $this->getOpiniones();
        return view('home')->with('homeData', $homeData)
                           ->with('staffData', $staffData)
                           //->with('entradas', $entradas)
                           ->with('tieneCursosCortos',$hasCursosCortos)
                           ->with('cursosCortos', $cursosCortos)
                           ->with('cursos', $cursos)
                           ->with('opiniones', $opiniones);

    }

    private function getInfoInicio($posts){
      $home = 'home';
      $homeData = [];
      foreach ($posts as $post) {
        $miSlug = substr($post->slug,0,-2);

          if ($miSlug == $home){
              $data = array (
                'titulo' => $post->title,
                'contenido' => $post->content
              );

              $homeData = \array_add($homeData, $post->slug, $data);
          }
      }
      return $homeData;
    }

    private function getInfoStaff($posts){
      $staff = 'staff';
      $staffData = [];
      foreach ($posts as $post) {
        $miSlug = substr($post->slug,0,-2);

          if ($miSlug == $staff){
              $nombre = substr($post->title,0,strpos($post->title,';'));
              $puesto = substr($post->title,strpos($post->title,';')+1,strlen($post->title));

              $data = array (
                'nombre' => $nombre,
                'puesto' => $puesto,
                'contenido' => $post->content
              );

              $staffData = \array_add($staffData, $post->slug, $data);
          }
      }
      return $staffData;
    }

    /*USE MODELOS CREADOS POR MI, NO CORCEL...*/
    private function getCursosCortos(){
      $id_term = Terms::where('name','cursos-cortos')->first()->term_id;

      $id_cat = Taxonomy::where('term_id',$id_term)
                        ->where('Taxonomy','category')
                        ->first()->term_taxonomy_id;

      $col_idcursos = RelTaxPosts::where('term_taxonomy_id',$id_cat)->get();

      $dataCursos = [];
      $i = 0;
      foreach($col_idcursos as $id_cursos){
        $curso = Posts::where('ID',$id_cursos->object_id)->first();


          //no es muy eficiente ya que recien aca filtro por los publicados...
          if ($curso->post_status == 'publish'){
            $hijo = Posts::where('post_parent',$id_cursos->object_id)
                          ->where('post_type','attachment')
                          ->orderBy('post_date','desc')
                          ->first();
            $i = $i + 1;
            $dataCurso = array(
              'id' => $i,
              'url-img' => env('WP_SITE').$hijo->guid,
              'tipo' => substr($curso->post_title,strpos($curso->post_title,';')+1,strlen($curso->post_title)),
              'titulo' => substr($curso->post_title,0,strpos($curso->post_title,';')),
              'fecha' => substr($curso->post_content,0,strpos($curso->post_content,';')),
              'descripcion' => substr($curso->post_content,strpos($curso->post_content,';')+1,strlen($curso->post_content))
            );

          $dataCursos = \array_add($dataCursos, $curso->post_name, $dataCurso);
        }
      }

      return $dataCursos;
    }

    private function getLastEntradas($posts){

      // quito las entradas que tengan estos slug.
      $staff = 'staff';
      $home = 'home';
      $opiniones = 'opnion';
      $i = 1;
      $entradas = [];
      foreach ($posts as $post){
        /* Si no es de staff, home ni opiniones-> entonces es del blog. */
        if (!(substr($post->slug,0,strlen($staff)) == $staff) &&
            !(substr($post->slug,0,strlen($home)) == $home) &&
            !(substr($post->slug,0,strlen($opiniones)) == $opiniones) &&
            $i <= 3){


            // obtengo el objeto post para buscar la imagen...
            $hijo = Posts::where('post_parent',$post->ID)
                          ->where('post_type','attachment')
                          ->first();

            $entrada = array(
              'titulo' => $post->title,
              'mini_contenido' => substr($post->content,0,40).'...',
              'imagen' => env('WP_SITE').$hijo->guid,
              'url' => $post->slug
            );

            $entradas = \array_add($entradas, $post->slug, $entrada);
            $i++;
          }
      }

      return $entradas;
    }

    private function getCursos(){
      $unformattedCursos = Page::status('publish')->get();
      $formatCursos = [];

      foreach ($unformattedCursos as $item){
        $one = array(
          'id' => $item->slug,
          'titulo' => $item->title,
        );

        $formatCursos = \array_add($formatCursos, $item->slug, $one);
      }

      return $formatCursos;
    }

    private function getOpiniones(){
      $id_term = Terms::where('name','opiniones')->first()->term_id;

      $id_cat = Taxonomy::where('term_id',$id_term)
                        ->where('Taxonomy','category')
                        ->first()->term_taxonomy_id;

      $col_idOpiniones = RelTaxPosts::where('term_taxonomy_id',$id_cat)->get();
      $opiniones = [];
      foreach ($col_idOpiniones as $idOpiniones) {

        $wp_opinion = Posts::where('ID', $idOpiniones->object_id)->first();

        $opinion = array(
          'alumno' => substr($wp_opinion->post_title, 0, strpos($wp_opinion->post_title,';')),
          'curso' => substr($wp_opinion->post_title, strpos($wp_opinion->post_title,';')+1, strlen($wp_opinion->post_title)),
          'opinion' => $wp_opinion->post_content,
        );

        $opiniones = \array_add($opiniones, $idOpiniones->object_id, $opinion);
      }

      return $opiniones;
    }
}
