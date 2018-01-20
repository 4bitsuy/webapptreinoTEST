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
            $menu->add('HOME');
            $menu->add('ESCUELA', 'escuela');
            $menu->add('CURSOS', 'cursos');
            $menu->add('CONTACTO', 'contactO');
        });
    }
}
