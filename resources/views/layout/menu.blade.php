<header>
    <nav class="back-black">
        <div class="nav-wrapper">
            <a class="brand-logo right shop" style="font-size:16px;padding-left:10px;" href="{{route('MisArticulos')}}">
                <i class="material-icons font-deft right" style="font-size:16px;">local_mall</i>
                Mis Artículos ( <b id="TotalCarrito">{{$articulos}}</b> )
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="left hide-on-med-and-down">
                <li><a><i class="material-icons left">person</i>Iniciar Sesión </a></li>
                <li><a><i class="material-icons left">exposure_plus_1</i>Registro</a></li>
                <li><a><i class="material-icons left">star</i>Favoritos </a></li>
                <li><a><i class="material-icons left">call</i>Atención al Cliente</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a>Iniciar Sesión</a></li>
        <li><a>Registro</a></li>
        <li><a>Favoritos</a></li>
        <li><a>Atención al Cliente</a></li>
    </ul>
    <div class="content-img">
        <a href="{{route('catalogoCamisas')}}">
            <img class=" img-fluid" src="{{ asset('/img/logo.png') }}">
        </a>
    </div>
</header>
<div id="page-loader"><span class="preloader-interior"></span></div>