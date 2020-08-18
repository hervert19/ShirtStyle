<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="row">
            <div class="col s2 m1 center" id="checkmodal">
                <i class="material-icons" style="color:#66bb6a;font-size:40px;">check_circle</i>
            </div>
            <div class="col s10 m11">
                <h5 style="margin-top: 5px;">Compra finalizada con éxito</h5>
            </div>
        </div>
        <hr class="divisor">
        <div class="row mb-0">
            <div class="col s12 m12 l6">
                <h5 class="mb-0 m12 l6 mt-0"><b>Detalles de la compra</b></h5>
            </div>
            <div class="col s12 m6 right">
                <h6 class="mb-0 mt-0 right">Numero de Pedido: <b id="numeropedido"></b></h6>
            </div>
        </div>
        <div class="col s12 m12 l7 green lighten-1 center text-white">
            <p class="white-text">Pago procesado correctamente </p>
        </div>
        <div style="display:flex;justify-content:center;margin-bottom:10px;">
            <img src="{{ asset('/img/logo_inv.png') }}" style="max-width:250px;">
        </div>
        <b>Empresa:</b> {{$empresa->nombre}}
        <br><b>Razón Social:</b> {{$empresa->razonsocial}} [{{$empresa->rfc}}].

        <hr class="divisor">
        <h5><b>Entrega de Producto: </b></h5>
        <b>Cliente:</b> {{$usuario->nombre}} {{$usuario->apellido}}<br>
        <b>Domicilio de Envio:</b> {{$usuario->recibedireccion}}, {{$usuario->recibecp}}, {{$usuario->recibeciudad}}, {{$usuario->pais}}.
        <br><b>Recibe:</b>{{$usuario->recibe}}.
        <br><b> Tel:</b> {{$usuario->recibetelefono}}.
        <p id="entrega1">
            <label>
                <input name="test1" type="radio" checked />
                <span class="black-text">
                    <b>{{$tiposenvio["Economico"]->metodo}}</b>
                    <br>Tú pedido estaría llegando entre {{$economico1}} & {{$economico2}}
                </span>
            </label>
        </p>
        <p id="entrega2">
            <label>
                <input name="test2" type="radio" checked />
                <span class="black-text">
                    <b>{{$tiposenvio["Express"]->metodo}}</b>
                    <br>Tú pedido estaría llegando el día {{$express}}
                </span>
            </label>
        </p>
        <h5><b>Total pagado</b></h5>
        <h5 id="respuestatotal"></h5>
        <p>Se ha enviado un mensaje a tu correo con los detalles de la compra, gracias por comprar en shirt Style.</p>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col s12 m6 l7"></div>
            <div class="col s12 m6 l5">
                <a href="{{route('catalogoCamisas')}}" class="modal-close waves-effect blue-grey darken-2 waves-green btn-flat white-text" style="width:100%;text-align:center">ACEPTAR</a>
            </div>
        </div>
    </div>
</div>