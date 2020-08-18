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
                        <a href="{{route('Registro')}}" class="breadcrumb">Registro</a>
                    </div>
                </nav>
                <div class="row">
                    <form id="FormRegistro">
                        @csrf
                        <input type="hidden" name="idusuario" value="{{$usuario->idusuario}}">
                        <div class="col s12 m6 l6">
                            <div class="card">
                                <div class="card-content white-text">
                                    <h5 style="color:#40c267;padding:15px;margin-top:0px;">
                                        <i class="material-icons left">assignment_turned_in</i> Registro
                                    </h5>
                                    <div class="row">
                                        <div class="input-field col s12 m12 l6">
                                            <input type="text" class="validate" id="nombre" name="nombre" placeholder="" value="{{$usuario->nombre}}" required>
                                            <label for="nombre">Nombre</label>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <input type="text" class="validate" id="apellido" name="apellido" placeholder="" value="{{$usuario->apellido}}" required>
                                            <label for="apellido">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m12 l6">
                                            <input type="text" class="validate" id="telefono" name="telefono" placeholder="" value="{{$usuario->telefono}}" required>
                                            <label for="telefono">Telefóno</label>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <input type="text" class="validate" id="email" name="email" placeholder="" value="{{$usuario->email}}" required>
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="input-field col s12 m12 l12">
                                            <input type="text" class="validate" id="direccion" name="direccion" placeholder="calle, número interior y exterior" value="{{$usuario->direccion}}"
                                                required>
                                            <label for="direccion">Direccion</label>
                                        </div>
                                        <div class="input-field col m12 l4">
                                            <input type="text" class="validate" id="cp" name="cp" placeholder="" value="{{$usuario->cp}}" required>
                                            <label for="cp">CP</label>
                                        </div>
                                        <div class="input-field col s12 m12 l4">
                                            <input type="text" class="validate" id="ciudad" name="ciudad" placeholder="" value="{{$usuario->ciudad}}" required>
                                            <label for="ciudad">Ciudad</label>
                                        </div>
                                        <div class="input-field col s12 m12 l4">
                                            <input type="text" class="validate" id="pais" name="pais" placeholder="" value="{{$usuario->pais}}" required>
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
                                        <i class="material-icons">place</i> Datos de Envio
                                    </h5>
                                    <div class="row">
                                        <p class="col s12" style="margin-bottom:11px;">
                                            <label>
                                                <input type="checkbox" id="identicos" onclick="CopyForm();" />
                                                <span>Son los mismos datos del registro</span>
                                            </label>
                                        </p>
                                        <div class="input-field col s12 m12 l6">
                                            <input type="text" class="validate" id="recibe" name="recibe" placeholder="" value="{{$usuario->recibe}}" required>
                                            <label for="recibe">Recibe</label>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <input type="text" class="validate" id="telefonorecibe" name="telefonorecibe" placeholder="" value="{{$usuario->recibetelefono}}" required>
                                            <label for="telefonorecibe">Telefóno</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <input type="text" class="validate" id="direccionrecibe" name="direccionrecibe" placeholder="calle, número interior y exterior"
                                                value="{{$usuario->recibedireccion}}" required>
                                            <label for="direccionrecibe">Direccion</label>
                                        </div>
                                        <div class="input-field col s12 m12 l4">
                                            <input type="text" class="validate" id="cprecibe" name="cprecibe" placeholder="" value="{{$usuario->recibecp}}" required>
                                            <label for="cprecibe">CP</label>
                                        </div>
                                        <div class="input-field col s12 m12 l4">
                                            <input type="text" class="validate" id="ciudadrecibe" name="ciudadrecibe" placeholder="" value="{{$usuario->recibeciudad}}" required>
                                            <label for="ciudadrecibe">Ciudad</label>
                                        </div>
                                        <div class="input-field col s12 m12 l4">
                                            <input type="text" class="validate" id="paisrecibe" name="paisrecibe" placeholder="" value="{{$usuario->recibepais}}" required>
                                            <label for="paisrecibe">País</label>
                                        </div>
                                        <p class="col s12">
                                            <label>
                                                <input type="checkbox" id="terminos" class="validate" required/> 
                                                <span>Acepto los Términos y Condiciones </span><br>
                                                <label><b>Términos y Condiciones</b> & <b>Políticas de Cancelación</b></label>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m12 l8 right mt-10">
                                <button class="btn waves-effect green darken-1" type="submit" name="action" style="width:100%;">CONTINUAR
                                    <i class="material-icons right">arrow_forward</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/registro.js') }}"></script>
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection