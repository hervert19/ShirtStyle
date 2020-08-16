<header>
    <nav class="back-black">
        <div class="nav-wrapper">
            <a class="brand-logo right shop" style="font-size:16px;padding-left:10px;" href="{{route('MisArticulos')}}">
                <i class="material-icons font-deft right" style="font-size:16px;">local_mall</i> Mis Artículos ( {{$articulos}} )
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="left hide-on-med-and-down">
                <li><a href="sass.html"><i class="material-icons left">person</i>Iniciar Sesión </a></li>
                <li><a href="mobile.html"><i class="material-icons left">exposure_plus_1</i>Registro</a></li>
                <li><a href="badges.html"><i class="material-icons left">star</i>Favoritos </a></li>
                <li><a href="collapsible.html"><i class="material-icons left">call</i>Atención al Cliente</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="sass.html">Iniciar Sesión</a></li>
        <li><a href="mobile.html">Registro</a></li>
        <li><a href="badges.html">Favoritos</a></li>
        <li><a href="collapsible.html">Atención al Cliente</a></li>
    </ul>
    <div class="content-img">
        <img class="img-fluid" src="{{ asset('/img/logo.png') }}">
    </div>
</header>