<div class="modal fade" id="section-inscripcion"tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="cerrar">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">(&times;) Cerrar</span>
            </button>
          </div>
        </div>
        <div class="modal-body">
          <h3>INSCRIPCIONES</h3>
          <form action="{{ url('inscripcion') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <input class="form-control" id="nombre" name="nombre" value="Nombre">
            </div>
            <div class="form-group">
              <input class="form-control" id="email" name="email" value="Correo Electrónico">
            </div>
            <div class="form-group">
              <input class="form-control" id="telefono" name="telefono" value="Teléfono">
            </div>
            <div class="form-group">
              <select class="form-control" id="curso" name="curso">
                <option value="">Curso</option>
                @foreach ($cursos as $curso)
                  @foreach ($curso as $key => $value)
                    @if ($key == 'id')
                      <option value="{!! $value !!}">
                    @endif
                    @if ($key == 'titulo')
                        {!! $value !!}</option>
                    @endif
                  @endforeach
                @endforeach

              </select>
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="5" id="mensaje" name="mensaje">Tu mensaje</textarea>
            </div>
            <input type="submit" class="btn btn-primary btn-contacto btn-contacto-curso" value="Enviar Mensaje">
          </form>
        </div>
      </div>
    </div>
</div>
