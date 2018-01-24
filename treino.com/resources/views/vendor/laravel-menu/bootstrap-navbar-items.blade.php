<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="images/logo-menu.png" class="img-responsive"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">

          @foreach($items as $item)
            <li@lm-attrs($item) @if($item->hasChildren())class ="dropdown"@endif @lm-endattrs>
              @if($item->link) <a@lm-attrs($item->link) @if($item->hasChildren()) class="dropdown-toggle" data-toggle="dropdown" @endif @lm-endattrs href="{!! $item->url() !!}">
                {!! $item->title !!}
                @if($item->hasChildren()) <b class="caret"></b> @endif
              </a>
              @else
                {!! $item->title !!}
              @endif
              @if($item->hasChildren())
                <ul class="dropdown-menu">
                  @include(config('laravel-menu.views.bootstrap-items'),
          array('items' => $item->children()))
                </ul>
              @endif
            </li>
            @if($item->divider)
            	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
            @endif
          @endforeach

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
