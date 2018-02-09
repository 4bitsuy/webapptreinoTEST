<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('NavBar', function ($menu) {
            $menu->add('HOME', ['route'  => 'home', 'id' => 'home']);

            $menu->add('ESCUELA', ['id' => 'escuela'])->link->href('#section-escuela');
            $menu->add('CURSOS', ['route'  => 'cursos.principal',
                                  'id' => 'cursos']);
            /*
            $menu->add('BLOG', ['route'  => 'blog.principal',
                                'id' => 'blog'])->active('blog/*');
            */
            $menu->add('CONTACTO', ['id' => 'contacto'])
                 ->attr([
                   'data-toggle' => 'modal',
                   'data-target' =>'#section-contacto',
                    ])
                  ->link->href('#');;
        });

        return $next($request);
    }
}
