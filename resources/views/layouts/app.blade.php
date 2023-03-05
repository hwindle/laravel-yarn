<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
  <link href="{{asset ('css/open-iconic/font/css/open-iconic-bootstrap.css')}}"
  rel="stylesheet">
  <link href="{{asset ('css/styles.min.css')}}" rel="stylesheet">

  <body>
  <!--[if lte IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
  <header>
  <div class="row no-gutters">
    <div id="logo" class="col-xs-4 col-sm-2">
      <img src="img/logo.png" alt="cable knitting" width="80px" height="80px" />
    </div>
    <div class="col-xs-8 col-sm-10">
      <h1>Yarn Haven</h1>
    </div>
  </div>
</header>


<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <ul class="navbar-nav mr-auto" id="navbarSupportedContent">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle"
      href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">Journal
        <span class="oi oi-menu"></span>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="indie_marketplace.html">Indie Marketplace</a>
        <a class="dropdown-item" href="{{ route('yarn') }}">Yarn</a>
        <a class="dropdown-item" href="help.html">
          <span class="oi oi-question-mark" aria-hidden="true" title="get help"></span>
          Help</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="projects.html">Projects</a>
        <a class="dropdown-item" href="queue.html">Queue</a>
        <a class="dropdown-item" href="stash/index.html">Stash</a>
        <a class="dropdown-item" href="library.html">Library</a>
        <a class="dropdown-item" href="friends.html">Friends</a>
        <a class="dropdown-item" href="messages.html">Messages</a>
        <a class="dropdown-item" href="cals.html">Craft alongs</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="gift-shop.html">Shop</a>
        @guest
        <div class="menu-end"></div>
        @else
        <a class="dropdown-item" href="my-account.html">My Account</a>
        <a class="dropdown-item" href="pro.html">Pro</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endguest
      </div>
    </li>

    <li class="nav-item larger-nav-item">
      <a class="nav-link" href="patterns.html">Patterns</a>
    </li>
    <li class="nav-item larger-nav-item">
      <a class="nav-link" href="forums.html">Forums</a>
    </li>
        @guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12  col-md-12 col-xl-10" id="main-content">
          @auth
          <div class="flash-msg">
            @if(session()->has('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}
              </div>
            @endif
          </div>

          @yield('content')

          @endauth
          @yield('guest-content')

        </div>

    <div class="col-xl-2 d-none d-xl-block" id="side-bar">
    <nav id="side-nav">
      <ul>
        <li><a href="indie_marketplace.html">Indie Marketplace</a>
        </li>
        <li><a href="{{ route('yarn') }}">Yarn</a></li>
        <li><a href="projects.html">Projects</a></li>
        <li><a href="queue.html">Queue</a></li>
        <li><a href="stash/yarn.html">Yarn Stash</a></li>
        <li><a href="friends.html">Friends</a></li>
        <li><a href="help.html">Help</a></li>
      </ul>
    </nav>
    <div id="ad-area-1" class="advert">
    </div>
  </div><!--sidebar-->
  </div><!--row-->
  <div class="row">
    <div id="ad-area-2" class="advert d-none d-sm-block col-sm-12">
  </div>
</div>
    <div class="row">
    <footer class="col-xs-12">&copy; Hazel Windle 2019</footer>
    </div>
  </div><!--container-fluid-->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- my scripts -->
    <script src="{{asset ('js/main.js')}}" type="text/javascript"></script>
    <!-- per page scripts for special one off DOM things. -->
    @yield('scripts')

    </body>
    </html>
