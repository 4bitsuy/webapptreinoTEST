var right = 0;
var n = $( "#id-cursos div" ).length;
var tope = n - 3;
$(document).ready(function() {
  dibujoTira(n);
});

$("#mas-cursos").click(function(){

  var right;
  if (tope >= 0){
    console.log("mostrar mas");
    for (i = 1; i <= n; i++){
      right = $("#"+i).css("right");
      right = parseInt(right);
      right = right - 460;
      $("#"+i).css("right",right);
      if (right < 0){
        $("#"+i).css("display","none");
      }
      if (right == 920){
        $("#"+i).css("display","block");
      }

    }
    tope--;
  }else if(tope <= n){
    tope++;
    console.log("mostrar menos")
  }
});

function dibujoTira(cantCursos){
  for (i = 1; i <= cantCursos; i++){
    $("#"+i).css("right",right);
    if (i > 3){
      $("#"+i).css("display","none");
    }
    right += 460;
  }
}
