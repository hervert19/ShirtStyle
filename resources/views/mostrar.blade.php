@include('layout.header', ['title' => 'Caballero'])
@include('layout.menu')
@php($imagen1 = $imagenes["imagen1"])
@php($imagen2 = $imagenes["imagen2"])
@php($imagen3 = $imagenes["imagen3"])
@php($imagen4 = $imagenes["imagen4"])
@php($imagen5 = $imagenes["imagen5"])
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white" style="padding:20px;">
            <div class="row">
                <div class="col s12 m7">
                    <img src='{{ asset("$imagen1") }}' class="materialboxed" style="max-width:100%;" id="imagencentral">
                
                    <div class="row center" id="gallery-min" style="margin-top:20px;">
                        <div class="col s3 m2">
                            <img src='{{ asset("$imagen1") }}' style="max-width:100%;" onclick="ViewImage(this)">
                        </div>
                        <div class="col s3 m2">
                            <img src='{{ asset("$imagen2") }}' style="max-width:100%;" onclick="ViewImage(this)">
                        </div>
                        <div class="col s3 m2">
                            <img src='{{ asset("$imagen3") }}' style="max-width:100%;" onclick="ViewImage(this)">
                        </div>
                        <div class="col s3 m2">
                            <img src='{{ asset("$imagen4") }}' style="max-width:100%;" onclick="ViewImage(this)">
                        </div>
                        <div class="col s3 m2">
                            <img src='{{ asset("$imagen5") }}' style="max-width:100%;" onclick="ViewImage(this)">
                        </div>
                    </div>

                </div>
                <div class="col s12 m5" style="padding:10px;">
                    <div class="card">
                        <div class="card-content white-text blue-grey darken-1" style="padding-top:15px;padding-bottom:15px;">
                            <span class="card-title"><i class="material-icons left">local_offer</i> Detalles del Producto</span>
                        </div>
                        <div class="card-action">
                            <div class="row mb-0">
                                <p class="col s12 m12 mt-0 mb-5"> {{$producto->descripcion}}</p>
                                <p class="col s12 m12 mt-0 mb-5"> MARCA: {{$producto->marca}}</p>
                                <p class="col s12 m6 left mt-0 mb-5"> Color: {{$producto->color}}</p>
                                <p class="col s12 m6 right mt-0 mb-5"> Código: {{$producto->codigo}}</p>
                                <h4 class="col s12 m12 center mt-0 mb-5"> $ {{$producto->precioventa}}</h4>
                                <label class="col s12 m12 mt-0 mb-5">Disponibles</label>
                                @foreach ($inventario as $item)
                                <p class="col s6 m3 right mt-0 mb-5">
                                    {{$item->talla->medida}} <label>({{$item->disponible}})</label>
                                </p>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-action">
                            <div class="row mb-0">
                                <form class="col s12">
                                    <input type="hidden" id="formprecio" value="{{$producto->precioventa}}">
                                    <div class="row">
                                        <div class="input-field col s12 m6">
                                            <select id="formtalla" class="validate center">
                                                @foreach ($inventario as $temptalla)
                                                @if ($temptalla->disponible > 0)
                                                @if ($temptalla->talla->idtalla == 1)
                                                <option value="{{$temptalla->talla->idtalla}}" selected>{{$temptalla->talla->medida}}</option>
                                                @else
                                                <option value="{{$temptalla->talla->idtalla}}">{{$temptalla->talla->medida}}</option>
                                                @endif
                                                @endif
                                                @endforeach
                                            </select>
                                            <label for="formtalla">Talla</label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input id="formcantidad" type="number" min="1" class="validate" value="$ 0.00" oninput="CalcularProducto();">
                                            <label for="formcantidad">Cantidad</label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <input id="formtotal" type="text" min="1" class="center" value="0" readonly>
                                            <label for="formtotal">Total</label>
                                        </div>
                                        <div class="input-field col s12 m6 center">
                                            <a class="waves-effect waves-light btn green darken-1"><i class="material-icons right">add</i>AGREGAR</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col s12 m5 right">
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">accessibility</i>Información de Tallas</div>
                            <div class="collapsible-body">
                                <span>
                                    @foreach ($tallas as $item)
                                    <p class="mt-0 mb-5">
                                        {{$item->medida}} <label>{{$item->descripcion}}</label>
                                    </p>
                                    @endforeach
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">payment</i>Formas de Pago</div>
                            <div class="collapsible-body"><span>Hasta 6 meses sin intereses con tarjetas participantes.</span>
                                <div class="row" style="background-color:#546e7a;">
                                    <div class="col s3 m3">
                                        <img src="{{ asset('/img/pay/paypal.png') }}" style="max-width:100%;">
                                    </div>
                                    <div class="col s3 m3">
                                        <img src="{{ asset('/img/pay/american.png') }}" style="max-width:100%;">
                                    </div>
                                    <div class="col s3 m3">
                                       <img src="{{ asset('/img/pay/masterdcard.png') }}" style="max-width:100%;">
                                    </div>
                                    <div class="col s3 m3">
                                        <img src="{{ asset('/img/pay/visa.png') }}" style="max-width:100%;">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">pan_tool</i>Politicas</div>
                            <div class="collapsible-body">
                                <span>
                                    Nuestra política de devolución es muy sencilla. Podrás devolver cualquier artículo comprado en Shirt Style por las siguientes causas:
                                    <p> <i class="material-icons left">check</i> Si el artículo presenta defectos de fabricación.</p>
                                    <p> <i class="material-icons left">check</i> Si existe equivocación en el artículo enviado, conservando la envoltura original de celofán (emplaye) y sin presentar
                                        muestras de maltrato.</p>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</main>
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection