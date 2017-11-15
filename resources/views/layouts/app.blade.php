<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Script -->
     <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                <!-- Left Side Of Navbar -->
                                <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#myModal">
                                    Ajouter un article
                                </button>
                                <!-- Button trigger modal -->
                                

                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                                            {{csrf_field()}}

                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            
                                              <div class="form-group">
                                                <label for="name-of-image">Titre</label>
                                                <input type="form-text" class="form-control" name="title" id="title" aria-describedby="name-help" placeholder="Entrer le titre du post" value="{{ old('title') }}" required>
                                                @if ($errors->has('title'))
                                                    <span class="text-warning">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                                <small id="name-help" class="form-text text-muted">Le titre du poste</small>
                                              </div>
                                              <div class="form-group">
                                                <label for="descritpion">Description des images</label>
                                                <textarea class="form-control" id="description" name="description" rows="5" value="{{ old('descritpion') }}"></textarea>
                                                @if ($errors->has('description'))
                                                    <span class="text-warning">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                              </div>
                                              <div class="form-group">
                                                <label for="InputFile">Images à ajouter</label>
                                                <input type="file" class="form-control-file" id="imgContent" name="imgContent[]" multiple aria-describedby="fileHelp" accept="image/*" value="{{ old('imgContent.*') }}" required>
                                                <small id="fileHelp" class="form-text text-muted">Maintenez Ctrl. pour selectionner plusieurs images à la fois</small>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Ajouter !</button>
                                          </div>
                                        </div>
                                      </div>
                                  </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <section class="jumbotron img-background personal-jumotron">
            <h1 class="text-center">title</h1>
        </section>
        <div class="container">
            @if ($errors->any())
                <div id="myAlert" class="alert alert-warning fade">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
            @if (session('success'))
                <div id="myAlert" class="alert alert-success fade">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function showAlert() {
            $("#myAlert").addClass("in");
        }

        function removeAlert() {
            $("#myAlert").addClass("out");
        }

        function removeAlertDisplay() {
            $("#myAlert").addClass("none");
        }

        window.setTimeout(function () {
            showAlert();
        }, 300);

        window.setTimeout(function () {
            removeAlert();
        }, 5000);

        window.setTimeout(function () {
            removeAlertDisplay();
        }, 5300);
    </script>

</body>
</html>
