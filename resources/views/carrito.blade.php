@include('layout.header', ['title' => 'Caballero'])
@include('layout.menu')
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white" style="padding:20px;">
            <h5>
                <i class="material-icons">local_mall</i> Mis Artículos ({{$articulos}})
            </h5>
            <div class="row">
                <div class="col m12 mb-20" id="div-caracteristicas">
                    <hr>
                    <div class="row">
                        <div class="col s4 m1">Artículo</div>
                        <div class="col s4 m3">Descripción</div>
                        <div class="col s4 m2">Precio</div>
                        <div class="col s4 m3">Cantidad</div>
                        <div class="col s4 m2">Total</div>
                        <div class="col s4 m1">Eliminar
                        </div>
                    </div>
                </div>
                @foreach ($carrito as $item)
                <div class="col m12 mb-20">
                    <div class="row">
                        <div class="col s4 m1">
                            @php($imagen1 = $item->producto->fotos["imagen1"])
                            <img src='{{ asset("$imagen1") }}' style="max-width:100%;">
                        </div>
                        <div class="col s4 m3">{{$item->producto->descripcion}}</div>
                        <div class="col s4 m2">$ {{$item->producto->precioventa}}</div>
                        <div class="col s4 m3">{{$item->cantidad}}</div>
                        <div class="col s4 m2"> $ {{$item->producto->precioventa * $item->cantidad }}</div>
                        <div class="col s4 m1">Eliminar
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection