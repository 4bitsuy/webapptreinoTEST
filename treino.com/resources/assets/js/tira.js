

$("#mas-cursos").click(function(){

  var right;
  if (tope >= 0){
    console.log("mostrar mas " + tope);
    for (i = 1; i <= n; i++){
      right = $("#"+i).css("right");
      right = parseInt(right);
      right = right - 460;
      $("#"+i).css("right",right);
      if (right < 0){
        $("#"+i).css({"opacity":"0","display":"none"});
      }
      if (right == 920){
        $("#"+i).css("display","block");
      }

    }
    tope--;
  }else if(tope <= n){
    tope++;
    console.log("mostrar menos " + tope);
  }

});

function dibujoTira(cantCursos, ancho){
  right = 0;
  if (ancho <= 320){
    console.log("mobile");
    for (i = 1; i <= cantCursos; i++){
      console.log(i+' '+right);
      $("#"+i).css("right",right);
      right += 320;
    }
  }
  if (ancho > 320 && ancho <= 480){
    console.log("big phones");
    for (i = 1; i <= cantCursos; i++){
      $("#"+i).css("right",right);
      right += 480;
    }
  }
  if (ancho > 480 && ancho <= 768){
    console.log("tablets");
    for (i = 1; i <= cantCursos; i++){
      $("#"+i).css("right",right);
      right += 360;
    }
  }
  if (ancho > 1200){
    console.log("desktop");
    for (i = 1; i <= cantCursos; i++){
      $("#"+i).css("right",right);
      if (i > 3){
        $("#"+i).css("display","none");
      }
      right += 460;
    }
  }
}
