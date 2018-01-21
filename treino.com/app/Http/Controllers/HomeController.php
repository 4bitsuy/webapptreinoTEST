<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;

class HomeController extends Controller
{
    public function index(){
        // All published posts
        $posts = Post::published()->get();
        $posts = Post::status('publish')->get();

        $home = 'home';
        $i = 0;
        $homeData = [];
        foreach ($posts as $post) {
          $miSlug = substr($post->slug,0,-2);

            if ($miSlug == $home){
                $data = array (
                  'titulo' => $post->title,
                  'contenido' => $post->content
                );

                $homeData = \array_add($homeData, $post->slug, $data);
                $i++;
            }
        }
        return view('home')->with('homeData', $homeData);

    }
}
