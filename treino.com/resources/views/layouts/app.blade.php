<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Treino - @yield('title')</title>


        <link rel="stylesheet" type="text/css" href="css/app.css">

    </head>
    <body>

        <header class="hidden-xs container-fluid nav-contact">
          <div class="container">
            <div class="phone"><span class="glyphicon glyphicon-earphone"></span> +(000) 987-6543</div>
            <div class="mail"><span class="glyphicon glyphicon-envelope"></span> info@treino.com.uy</div>
          </div>
        </header>
        @include(config('laravel-menu.views.bootstrap-items'), ['items' => $NavBar->roots()])

        <section class="page">
            @yield('content')
        </section>

        <div class="inscripcion container-fluid hidden-xs">
          <div class="container">
            <h5>
              Pagá la inscripción a tus cursos de forma sencilla y online
              <a href="#" class="btn btn-inscribite pull-right">En este sitio!</a>
            </h5>
          </div>
        </div>

        <section class="pie container">
            @yield('pie')
        </section>

        <footer class="container-fluid">
          <div class="container">
            <span>Desarrollado por <a href="#"> <img src="images/4bits.png" alt="" class="img-copyright"></a></span>
          </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>
