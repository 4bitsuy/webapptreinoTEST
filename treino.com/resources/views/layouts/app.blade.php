<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="token" name="token" content="{{ csrf_token() }}">

        <title>Treino - @yield('title')</title>


        <link rel="stylesheet" type="text/css" href="css/app.css">

    </head>
    <body>
        @if (session('status'))
            <div class="alert alert-success msg">
              {!! array_get(session('status'), 'mail')  !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif

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

        <section class="pie container">
            @yield('pie')
        </section>

        <footer class="container-fluid">
          <div class="container">
            <span>Desarrollado por <a href="#"> <img src="images/4bits.png" alt="" class="img-copyright"></a></span>
          </div>
        </footer>

        @include('contacto.form')

        <script src="js/jquery-3.3.1.min.js" charset="utf-8"></script>
        <script src="js/bootstrap.min.js" charset="utf-8"></script>
        @include ('footer')
        <script src="js/main.js" charset="utf-8"></script>

    </body>
</html>
