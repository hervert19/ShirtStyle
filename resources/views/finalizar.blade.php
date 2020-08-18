@include('layout.header', ['title' => 'Finalizar Compra'])
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
                        <a href="{{route('FinalizarCompra')}}" class="breadcrumb">Finalizar</a>
                    </div>
                </nav>
                <form id="formFinalizar">
                    @csrf
                    <input type="hidden" name="idusuario" value="{{$usuario->idusuario}}">
                    <div class="row">
                        <div class="col s12 m12 l6">
                            <div class="row">
                                <div class="col s12 m10 l12">
                                    <div class="card">
                                        <div class="card-content">
                                            <span class="card-title" style="color:#40c267;">
                                                <i class="material-icons">local_shipping</i> Metodo de Envio
                                            </span>
                                            @php
                                            setlocale(LC_TIME, "spanish");
                                            $hoy = date("d-m-Y");
                                            $express = date("d-m-Y",strtotime($hoy."+ 1 days"));
                                            $economico1 = date("d-m-Y",strtotime($hoy."+ 2 days"));
                                            $economico2 = date("d-m-Y",strtotime($hoy."+ 3 days"));
                                            @endphp
                                            <input type="hidden" id="eleccionenvio" name="eleccionenvio" value="1">
                                            <p>
                                                <label>
                                                    <input name="group1" type="radio" value='{{$tiposenvio["Economico"]->precio}}' id="item-1" onclick="sumartotal(this)" checked />
                                                    <span class="black-text">
                                                        <b>{{$tiposenvio["Economico"]->metodo}}</b>
                                                        <br>Tú pedido estaría llegando entre {{$economico1}} & {{$economico2}}
                                                        <br>Costo Aproximado: ${{$tiposenvio["Economico"]->precio}} MXN <label>(Cósto extra sobre pedido)</label>
                                                    </span>
                                                </label>
                                            </p>
                                            <br>
                                            <p>
                                                <label>
                                                    <input name="group1" type="radio" value='{{$tiposenvio["Express"]->precio}}' id="item-2" onclick="sumartotal(this)" />
                                                    <span class="black-text">
                                                        <b>{{$tiposenvio["Express"]->metodo}}</b>
                                                        <br>Tú pedido estaría llegando el día {{$express}}
                                                        <br>Costo Aproximado: ${{$tiposenvio["Express"]->precio}} MXN <label>(Cósto extra sobre pedido)</label>
                                                    </span>
                                                </label>
                                            </p>
                                            <br>
                                            <b>Domicilio de Envio:</b><br>
                                            {{$usuario->recibedireccion}}, {{$usuario->recibecp}}, {{$usuario->recibeciudad}}, {{$usuario->pais}}.
                                            <br><b>Recibe:</b>
                                            {{$usuario->recibe}}.
                                            <br><b> Tel:</b> {{$usuario->recibetelefono}}.
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m10 l12">
                                    <div class="card">
                                        <div class="card-content">
                                            <span class="card-title">
                                                <div class="row" id="paymentcard">
                                                    <div class="col s8 m6 l6">
                                                        <i class="material-icons">payment</i> Forma de Pago
                                                    </div>
                                                    <div class="col s4 m6 l6" id="paybox">
                                                        <div class="row">
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
                                                </div>
                                            </span>
                                            <div class="row">
                                                <div class="col s6">
                                                    <label>
                                                        <input name="tipotarjeta" type="radio" checked />
                                                        <span class="black-text">Tarjeta de Credito</span>
                                                    </label>
                                                </div>
                                                <div class="col s6">
                                                    <label>
                                                        <input name="tipotarjeta" type="radio" />
                                                        <span class="black-text">Tarjeta de Debito</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col col s12 m6 l12">
                                                    <input id="numerotarjeta" name="numerotarjeta" type="text" class="validate" placeholder="1234 2345 5678 9870" maxlength="19" minlength="19"
                                                        required>
                                                    <label for="numerotarjeta">Numero de Tarjeta</label>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                    <input id="expiracion" name="expiracion" type="text" class="validate" placeholder="MM/AA" maxlength="5" minlength="5" required>
                                                    <label for="expiracionn">Fecha de Expiración</label>
                                                </div>
                                                <div class="input-field col s12 m5 l6">
                                                    <input id="seguridad" name="seguridad" type="text" class="validate" placeholder="CVV" maxlength="3" minlength="3" required>
                                                    <label for="seguridad">Código de Seguridad</label>
                                                </div>
                                                <div class="input-field col s12 m7 l12">
                                                    <input id="titular" name="titular" type="text" class="validate" placeholder="" required>
                                                    <label for="titular">Nombre del Titular</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $totalgeneral = 0;
                        $temptotal = 0;
                        @endphp
                        <div class="col s12 m10 l6">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title" style="color:#40c267;">
                                        <i class="material-icons">person_pin</i> Resumen de Compra
                                    </span>
                                    <div style="display:flex;justify-content:center;margin-bottom:20px;">
                                        <img src="{{ asset('/img/logo_inv.png') }}" style="max-width:250px;">
                                    </div>
                                    <hr class="divisor">
                                    <label><b>Proveedor: </b>{{$empresa->nombre}}. {{$empresa->razonsocial}} [{{$empresa->rfc}}]. </label>
                                    <label><b>Cliente: </b>{{$usuario->nombre}} {{$usuario->apellido}}. Teléfono {{$usuario->telefono}}. </label>
                                    <hr class="divisor">
                                    <div class="row">
                                        @foreach ($carrito as $item)
                                        @php
                                        $imagen1 = $item->producto->fotos["imagen1"];
                                        $temptotal = $item->producto->precioventa * $item->cantidad;
                                        $totalgeneral += $temptotal;
                                        @endphp
                                        <div class="col m12">
                                            <div class="row">
                                                <div class="col s2 m2 l2 center">
                                                    <img src='{{ asset("$imagen1") }}' style="max-width:100%;">
                                                    <label>$ {{$item->producto->precioventa}}</label>
                                                </div>
                                                <div class="col s5 m5 l5 center">
                                                    {{$item->producto->descripcion}}
                                                </div>
                                                <div class="col s2 m2 l2 center">
                                                    <span class="new badge">{{$item->cantidad}}</span>
                                                    <span class="new2 badge">{{$item->talla->medida}}</span>
                                                </div>
                                                <div class="col s3 m3 l3 center">
                                                    <b>$ {{ number_format($temptotal, 2, '.', '') }}</b>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td hidden>
                                                    <input type="hidden" id="subtotal" name="subtotal" value="{{$totalgeneral}}">
                                                </td>
                                                <td class="right">Subtotal</td>
                                                <td class="center"><b>$</b> <b>{{number_format($totalgeneral, 2, '.', '')}}</b></td>
                                            </tr>
                                            <tr>
                                                <td class="right">Costo de Envio</td>
                                                <td class="center"><b>$</b> <b id="htmlenvio">80</b></td>
                                            </tr>
                                            <tr>
                                                <td hidden>
                                                    <input type="hidden" id="total" name="total" value="{{$totalgeneral + 80}}">
                                                </td>
                                                <td class="right">Total</td>
                                                <td class="center"><b>$</b> <b id="htmltotal">{{number_format($totalgeneral + 80, 2, '.', '')}}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="row">
                                        <div class="col s12">
                                            <button class="btn waves-effect green darken-1" type="submit" name="action" style="width:100%;">FINALIZAR
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('Detalles')
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/registro.js') }}"></script>
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection