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
            $menu->add('ESCUELA', ['route'  => 'escuela.principal', 'id' => 'escuela']);
            $menu->add('CURSOS', ['route'  => 'cursos.principal', 'id' => 'cursos']);
            $menu->add('CONTACTO', ['route'  => 'contacto.principal', 'id' => 'contacto']);
        });

        return $next($request);
    }
}
