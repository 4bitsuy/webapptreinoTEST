
@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="cursos-cortos container-fluid">
  <h3>cursos <span>cortos</span></h3>

  <button type="button" name="button" id="mas-cursos" class="ver-mas"></button>
</div>
<div id="id-cursos" class="cursos">
  <div id="1" class="img-curso" style="background: url(images/curso.jpg) center center;">
    PRUEBA
  </div>
  <div id="2" class="img-curso" style="background: url(images/curso.jpg) center center;">
    PRUEBA
  </div>
  <div id="3" class="img-curso" style="background: url(images/curso.jpg) center center;">
    PRUEBA
  </div>
  <div id="4" class="img-curso" style="background: url(images/curso.jpg) center center;">
    PRUEBA
  </div>
  <div id="5" class="img-curso" style="background: url(images/curso.jpg) center center;">
    PRUEBA
  </div>
</div>


<div id="inicio" class="inicio container-fluid">
  <div class="container">
    <div class="col-lg-12">
      <h3>{!!array_get($homeData, 'home_1.titulo') !!}</h3>
      <p>{!! array_get($homeData, 'home_1.contenido') !!}</p>
      <a href="#" class="btn btn-contacto">CONTACTO / INSCRIPCIONES</a>
      <!--<button type="button" class="btn btn-contacto" name="button"></button>-->
    </div>

    @for ($i = 2; $i <= 4; $i++)
      <div class="col-md-4">
        <img src="images/icon-{{$i-1}}.png" alt="" class="icono-home">
        <div class="cont-home">
          <h5>{!!array_get($homeData, 'home_'.$i.'.titulo') !!}</h5>
          <p>{!!array_get($homeData, 'home_'.$i.'.contenido') !!}</p>
        </div>
      </div>
    @endfor
  </div>
</div>

<div id="staff" class="staff">
  <div class="container">
    <div class="col-lg-12 text-center">
      <h3>NUESTRO STAFF</h3>
      <h5>Contamos con un equipo de reconocidos docentes</h5>

      @for ($i = 1; $i <= 3; $i++)
        <div class="col-sm-4">
          <div class="one-person">
            {!! array_get($staffData, 'staff_'.$i.'.contenido') !!}
          </div>
          <h6>
            <span>{!!array_get($staffData, 'staff_'.$i.'.nombre') !!}</span> - {!!array_get($staffData, 'staff_'.$i.'.puesto') !!}
            <img src="images/staff_{{$i}}.jpg" alt="" class="img-responsive img-staff">
          </h6>
        </div>
      @endfor
    </div>
  </div>
</div>

@endsection

@section('pie')
  <div class="pie-cont col-sm-4 text-left">
    <h4>BLOG</h4>
    <ul class="blog">
      @foreach ($entradas as $entrada)
        <li>
          @foreach ($entrada as $key => $value)
            @if ($key == 'titulo')
              <h6>{!!$value!!}</h6>
            @endif
            @if ($key == 'mini_contenido')
              <p>{!!$value!!}</p>
            @endif
            @if ($key == 'imagen')
              <img src="{{$value}}" alt="" class="img-responsive">
            @endif
            @if ($key == 'url')
              <a href="blog/{{$value}}">Ver nota</a>
            @endif
          @endforeach
        </li>
      @endforeach
    </ul>
  </div>
  <div class="pie-cont col-sm-4 text-center">
    <img src="images/logo-pie.png" alt="" class="img-responsive img-logo-pie">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
    <div class="block-social">
      <a href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
    </div>
  </div>
  <div class="pie-cont col-sm-4 text-center">
    OPINIONES
  </div>
@endsection
