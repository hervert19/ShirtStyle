@include('layout.header', ['title' => 'Mis Artículos'])
@include('layout.menu')
@php($totalgeneral = 0)
@php($temptotal = 0)
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white" style="padding:20px;">
            <nav id="indices">
                <div class="col s12 right">
                    <a href="{{route('catalogoCamisas')}}" class="breadcrumb">Inicio</a>
                    <a href="{{route('catalogoCamisas')}}" class="breadcrumb">Catálogo</a>
                    <a href="{{route('MisArticulos')}}" class="breadcrumb">Mis Artículos</a>
                </div>
            </nav>
            <h5 style="color:#40c267;padding:15px;margin-top:0px;">
                <i class="material-icons">local_mall</i> Mis Artículos ({{$articulos}})
            </h5>
            <div class="row">
                <div class="col m12 mb-20" id="div-caracteristicas">
                    <hr>
                    <div class="row">
                        <div class="col s4 m1 center"><b>Artículo</b></div>
                        <div class="col s4 m3 center"><b>Descripción</b></div>
                        <div class="col s4 m1 center"><b>Talla</b></div>
                        <div class="col s4 m2 center"><b>Precio</b></div>
                        <div class="col s4 m2 center"><b>Cantidad</b></div>
                        <div class="col s4 m2 center"><b>Total</b></div>
                        <div class="col s4 m1 center"></div>
                    </div>
                </div>
                @if (count($carrito) != 0)
                @foreach ($carrito as $item)
                <div class="col m12">
                    <hr id="hr-default">
                    <div class="row">
                        <div class="col s12 m1 center">
                            @php($imagen1 = $item->producto->fotos["imagen1"])
                            <a href="{{route('detalleProducto', ['id' => base64_encode($item->idproducto)])}}" target="_blank">
                                <img src='{{ asset("$imagen1") }}' style="max-width:100%;">
                            </a>
                        </div>
                        <div class="col s12 m3 center salto">{{$item->producto->descripcion}}</div>
                        <div class="col s12 m1 center salto">{{$item->talla->medida}}</div>
                        <div class="col s12 m2 center salto"><label id="preciolabel">Precio</label> $ {{$item->producto->precioventa}}</div>
                        <div class="col s12 m2 center">
                            <div class="row">
                                <div class="col s4 m4 center">
                                    <a class="btn-floating waves-effect orange darken-2 tooltipped" data-position="top" data-tooltip="Remover" id="remove-{{$item->idcarrito}}" onclick="ChangeItem(this)">
                                        <i class="material-icons">remove</i>
                                    </a>
                                </div>
                                <div class="col s4 m4 center">
                                    <input id="cant-{{$item->idcarrito}}" type="text" class="center" value="{{$item->cantidad}}" readonly>
                                </div>
                                <div class="col s4 m4 center">
                                    <a class="btn-floating  waves-effect blue-grey darken-1 tooltipped" data-position="top" data-tooltip="Añadir" id="add-{{$item->idcarrito}}" onclick="ChangeItem(this)">
                                        <i class="material-icons">add</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @php($temptotal = $item->producto->precioventa * $item->cantidad)
                        @php($totalgeneral += $temptotal)
                        <div class="col s12 m2 center salto"><label id="totallabel">Total</label> $ {{ number_format($temptotal, 2, '.', '') }}</div>
                        <div class="col s12 m1 center">
                            <a class="btn-floating waves-effect red accent-2 tooltipped" data-position="top" data-tooltip="Eliminar Artículo" id="item-{{$item->idcarrito}}"
                                onclick="getFormDelete(this)">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col s12 m12">
                    <hr id="hr-default">
                    <div class="row">
                        <div class="col s12 m6 center"></div>
                        <div class="col s3 m3" style="text-align:right;">
                            <b>Total</b></div>
                        <div class="col s9 m2 center">
                            <input id="first_name" type="text" class="center" value="$ {{number_format($totalgeneral, 2, '.', '')}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12">
                    <div class="row mb-0">
                        <div class="col s12 m8 "></div>
                        <div class="col s12 m4">
                            <a class="waves-effect waves-light btn green darken-1" href="{{route('Registro')}}" style="width:100%;">
                                <i class="material-icons right">arrow_forward</i>CONTINUAR
                            </a>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col m12 red accent-2 center text-white">
                       <p class="white-text">No se encontraron artículos.</p>
                    </div>
                </div>
                <br><br>
                <div class="col s12 m12">
                    <div class="row mb-0">
                        <div class="col s12 m8 "></div>
                        <div class="col s12 m4">
                            <a class="waves-effect waves-light btn green darken-1" href="{{route('catalogoCamisas')}}" style="width:100%;">
                                <i class="material-icons left">arrow_back</i>REGRESAR
                            </a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</main>
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection