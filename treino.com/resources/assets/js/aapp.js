/** variables Home **/
var right = 0;
var n = $( "#id-cursos-cortos a" ).length;
var tope = n - 3;
var ancho = $(window).width();

$(document).ready(function() {

  /** webPage Home **/
  // dibujoTira(n, ancho);
  console.log("prueba");
  $("#opiniones").slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    });

  /** webPage Cursos **/
  $('div#cursos').on('click', 'div.fondo-curso', function(){
    var idCursos = $(this).attr('id');
    //alert($(this).attr('id'));

    getInfoCursos(idCursos);
  });
});
