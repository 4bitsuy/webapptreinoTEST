@extends('layouts.app')

@section('title', 'CURSOS')

@section('content')
    <h2 class="not-home">NUESTROS CURSOS</h2>
    <div id="cursos" class="container-fluid cursos">
      @foreach ($cursos as $curso)
        @foreach ($curso as $key => $value)
          @if ($key == 'id')
            <div class="col-xs-6 col-lg-3 fondo-curso" id="{!! $value !!}">
          @endif
          @if ($key == 'titulo')
              <h4>{!! $value !!}</h4>
          @else
            @if ($key == 'imagen')
                <img src="{!! $value !!}" alt="" class="img-responsive">
              </div>
            @endif
          @endif
        @endforeach
      @endforeach
    </div>
    <section id="datos-cursos" class="container-fluid data-cursos">
      <div class="col-lg-12 noSel">
        <p class="uno">NO HAS SELECCIONADO NINGUN CURSO</p>
        <p class="dos">(Seleccioná una opción de arriba)</p>
      </div>
    </section>

    <div class="promociones container-fluid">
      <div class="col-sm-3">
        <h4>¡Promociones!</h4>
      </div>
      <div class="col-sm-3">
        <p>
          <i class="fa fa-check-square-o"></i>
          15% de bonificación pagando contado
        </p>
      </div>
      <div class="col-sm-3">
        <p>
          <i class="fa fa-check-square-o"></i>
          Inscripciones realizadas en Noviembre-Diciembre 2017 tienen la ultima cuota gratis
        </p>
      </div>
      <div class="col-sm-3">
        <p>
          <i class="fa fa-check-square-o"></i>
          Alumnos de Treino 15% descuento (descuentos no acumulables)
        </p>
      </div>
    </div>
@endsection

@section('pie')
  @include('contacto.form-cursos', ['cursos' => $cursos])
@endsection
