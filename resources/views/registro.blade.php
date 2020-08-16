@include('layout.header', ['title' => 'Registro'])
@include('layout.menu')
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white">
            <div style="padding:20px;">
                <nav id="indices">
                    <div class="col s12 right">
                        <a href="{{route('catalogoCamisas')}}" class="breadcrumb">Inicio</a>
                        <a href="{{route('catalogoCamisas')}}" class="breadcrumb">Catálogo</a>
                        <a href="{{route('MisArticulos')}}" class="breadcrumb">Mis Artículos</a>
                    </div>
                </nav>
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-content white-text">
                                <h5 style="color:#40c267;padding:15px;margin-top:0px;">
                                    <i class="material-icons">local_mall</i> Registro
                                </h5>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="nombre" type="text" class="validate">
                                        <label for="nombre">Nombre</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="apellido" type="text" class="validate">
                                        <label for="apellido">Apellido</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="telefono" type="text" class="validate">
                                        <label for="telefono">Telefóno</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="email" type="text" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="direccion" type="text" class="validate" placeholder="calle, número interior y exterior">
                                        <label for="direccion">Direccion</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input id="cp" type="text" class="validate">
                                        <label for="cp">CP</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input id="ciudad" type="text" class="validate">
                                        <label for="ciudad">Ciudad</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input id="pais" type="text" class="validate">
                                        <label for="pais">País</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-content white-text">
                                <h5 style="color:#40c267;padding:15px;margin-top:0px;">
                                    <i class="material-icons">local_mall</i> Datos de Envio
                                </h5>
                                <div class="row">
                                    <p class="col s12">
                                        <label>
                                            <input type="checkbox" />
                                            <span>Son los mismos datos del registro</span>
                                        </label>
                                    </p>
                                    <div class="input-field col s6">
                                        <input id="recibe" type="text" class="validate">
                                        <label for="recibe">Recibe</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="telefonorecibe" type="text" class="validate">
                                        <label for="telefonorecibe">Telefóno</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="direccionrecibe" type="text" class="validate" placeholder="calle, número interior y exterior">
                                        <label for="direccionrecibe">Direccion</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input id="cprecibe" type="text" class="validate">
                                        <label for="cprecibe">CP</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input id="ciudadrecibe" type="text" class="validate">
                                        <label for="ciudadrecibe">Ciudad</label>
                                    </div>
                                    <div class="input-field col m4">
                                        <input id="paisrecibe" type="text" class="validate">
                                        <label for="paisrecibe">País</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col m8 right mt-10">
                            <button class="btn waves-effect green darken-1" type="submit" name="action" style="width:100%;">CONTINUAR
                                <i class="material-icons right">arrow_forward</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection