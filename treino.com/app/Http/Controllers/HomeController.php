<?php
//rs
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use App\Models\Posts;

class HomeController extends Controller
{
    public function index(){
        // All published posts
        $posts = Post::newest()->status('publish')->get();
        //$posts = Post::status('publish')->get();

        $homeData = $this->getInfoInicio($posts);
        $staffData = $this->getInfoStaff($posts);
        $entradas = $this->getLastEntradas($posts);

        return view('home')->with('homeData', $homeData)
                           ->with('staffData', $staffData)
                           ->with('entradas', $entradas);

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
}
