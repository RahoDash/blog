<link rel="stylesheet" href="../darkroomjs-master/build/darkroom.css">
<link rel="stylesheet" href="./darkroomjs-master/demo/css/page.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
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
                    <span class="logo"></span>
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
                                <!-- Button trigger modal -->
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div id="content">
        <div class="container">
            <section class="copy">
                <h2>Introduction</h2>
                <p>
                    Il faudra enregistrer les modifications avec le bouton disque qui se trouve en haut de l'image, avant de valider votre édition.<br/>
                    Si le panneau flotant à disparu il faut recharcher la page.
                </p>
                <br/>
                <br/><br/>
                <br/>

                <form action="" ></form>
                <div class="figure-wrapper">
                    <img src="{{asset('/storage/'.$photo->photo_path)}}" alt="DomoKun" id="target" onchange="sendSrcCode(this.src)">
                </div>
                <button type="submit" id="btn" class="btn btn-primary btn-validate" onclick="updateSrc()" >Valider la photo</button>
            </section>
        </div>
    </div>
</div>

<script src="./darkroomjs-master/demo/vendor/fabric.js"></script>
<script src="../darkroomjs-master/build/darkroom.js"></script>

    <script>

        var dkrm = new Darkroom('#target', {
            // Size options
            minWidth: 100,
            minHeight: 100,
            maxWidth: 600,
            maxHeight: 500,
            ratio: 4/3,
            backgroundColor: '#000',

            // Plugins options
            plugins: {
                //save: false,
                crop: {
                    quickCropKey: 67, //key "c"
                    //minHeight: 50,
                    //minWidth: 50,
                    //ratio: 4/3
                }
            },

            // Post initialize script
            initialize: function() {
                var cropPlugin = this.plugins['crop'];
                // cropPlugin.selectZone(170, 25, 300, 300);
                cropPlugin.requireFocus();
            }
        });

        function updateSrc() {


            var src = document.querySelector("img").getAttribute("src");

            var host = './image';


            var id = '{{$photo->id}}';
            $.ajax({
                type: "POST",
                url: host,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {imageData:src, id: id, "_token": "{{ csrf_token() }}"},
                success: function(data) {
                    alert(data);
                }
            });
        }
    </script>


