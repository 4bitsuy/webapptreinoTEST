
function getInfoCursos(id){
  $('#datos-cursos').html('');

  $('div#cursos div').removeClass('activa');
  $('#'+id).addClass('activa');

  var dato = "curso="+id;
  $.ajax({

    data:     dato,
    url:      'cursos',
    type:     'post',
    beforeSend: function(xhr){
      xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
    },
    success:  function (data) {

      /**
    •  con r, agarro todos los caracteres raros definidos por el unicode de javascript (ej: "\u0025")
    •  a string le asigno lo que devuelvo desde php.
    •  luego en la llamada a fromCharCode (creo que) cambio a la codificacion definida para el js,
      (aca entra en juego lo que instalamos en gulp, entonces ya tengo el string en utf8).
    •  y la llamada final al encode, son para caracteres especiales como: "\", para los tildes no hace falta,
      pero se lo meti por las deudas.
      **/

      console.log(data);
      var r = /\\u([\d\w]{4})/gi;
      var string = data.resultado;
      string = string.replace(r, function(match, grp){
        return String.fromCharCode(parseInt(grp, 16));
      });
      string = unescape(string);

      var arreglo = string.split('},');

      if (arreglo.length > 1) {
        html = arreglo.forEach(dibujoHtml);
      } else {
        console.log(arreglo[0]);
        $('#datos-cursos').append('<h5>' + limpio(arreglo[0]) + '</h5>');
      }
    }
  });
}

function dibujoHtml(item,index){
  var html = '';
  if (index === 0){
    html = primerColumna(item);
  } else if (index === 1) {
    html = segundaColumna(item);
  } else{
    html = pie(item);
  }
  $('#datos-cursos').append(html);
}

function primerColumna(linea){
  var arreglo = linea.split(',');
  /***
  [0]: comienzo
  [1]: dias
  [2]: comienzo
  [3]: hora
  ***/
  var arrCom  = arreglo[0].split(':'),
      arrDias = arreglo[1].split(':'),
      arrDur  = arreglo[2].split(':'),
      arrHora = arreglo[3].split(':');
  var comienzo  = arrCom[2],
      dias      = arrDias[1],
      duracion  = arrDur[1],
      hora      = '';
      for (var i = 1; i < arrHora.length; i++) {
        hora += arrHora[i] + ':';
      }
  hora = hora.substring(0, hora.length-1)

  html  = '<div class="col-sm-6 column first">';
  html += '   <h5>DATOS CLAVE</h5>';
  html += '   <div class="col-lg-6 left">';
  html += '     <h6>COMIENZO</h6>';
  html += '     <p>' + limpio(comienzo) + '</p>';
  html += '   </div>'
  html += '   <div class="col-lg-6 right">'
  html += '     <h6>Dias</h6>'
  html += '     <p>' + limpio(dias) + '</p>';
  html += '   </div>'
  html += '   <div class="col-lg-6 left">'
  html += '     <h6>Duración</h6>'
  html += '     <p>' + limpio(duracion) + '</p>'
  html += '   </div>'
  html += '   <div class="col-lg-6 right">'
  html += '     <h6>Horario</h6>'
  html += '     <p>' + limpio(hora) + '</p>'
  html += '   </div>'
  html += '</div>'

  return html;
}

function segundaColumna(linea){
  var arreglo = linea.split('[');

  /****
  [1]: dirigido
  [2]: info
  [3]: descripcion
  ****/
  var dirarr = arreglo[1].split(']');
  var dir = dirarr[0].split(',');
  var infoarr = arreglo[2].split(']');
  var info = infoarr[0].split(',');
  var dsc = arreglo[3].split(']');

  html  = '<div class="col-sm-6 column second">';
  html += '  <h5>INFO DEL CURSO</h5>';
  html += '  <div class="col-lg-6">';
  html += '    <h6>A QUIEN ESTÁ DIRIGIDO</h6>';
  html += '    <ul>';
  for (var i = 0; i < dir.length; i++) {
    html += '     <li><i class="fa fa-check"></i> ' + limpio(dir[i]) +'</li>';
  }
  html += '    </ul>';
  html += '  </div>';
  html += '  <div class="col-lg-6">';
  html += '    <h6>Condiciones de ingreso</h6>';
  html += '    <ul>';
  for (var i = 0; i < info.length; i++) {
    html += '     <li><i class="fa fa-check"></i> ' + limpio(info[i]) +'</li>';
  }
  html += '    </ul>';
  html += '    <h6>Descripción del curso</h6>';
  html += '    <p> ' + dsc[0] + '</p>';
  html += '  </div>';
  html += '</div>';

  return html;
}

function pie(linea){
  var costo = linea.split(':');
  html  = '<div class="col-lg-6 pieLeft">';
  html += '  <p>COSTO MENSUAL: $' + limpio(costo[1].substring(0, costo[1].length-1)) + '</p>';
  html += '</div>';
  html += '<div class="col-lg-6 pieRight">';
  html += '  <p><a href="#">DESCARGAR PROGRAMA Y + INFORMACIÓN</a></p>';
  html += '</div>';

  return html;
}

function limpio(str){
  str = str.replace(/\"/,'');
  return str.replace(/\"/,'');
}
