@include('layout.header', ['title' => 'Catálogo Camisas'])
@include('layout.menu')
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white">
            <div class="row" style="padding:10px;">
                @foreach ($productos as $item)
                <div class="col s12 m4">
                    <div class="card">
                        <a href="{{route('detalleProducto', ['id' => base64_encode($item->idproducto)])}}" target="_blank">
                            <div class="card-image">
                                @php($imagen = $item->fotos->imagen1)
                                @php($imagen2 = $item->fotos->imagen5)
                                <img src="{{ asset("$imagen") }}" id="{{$item->codigo}}" onmouseover="ChangeImage(this);" onmouseout="ReturnImage(this);">
                                <input type="hidden" value="{{$imagen2}}" id="{{$item->codigo}}two">
                            </div>
                        </a>
                        <div class="card-content" style="height:140px;">
                            <p>{{$item->descripcion}} ({{$item->codigo}})</p>
                            <div class="row">
                                <p class="col s12 m12 text-left">
                                    MARCA {{$item->marca}}
                                </p>
                                <p class="col s12 m6 text-left">
                                    Color: {{$item->color}}
                                </p>
                                <p class="col s12 m6 text-right"><b>$ {{$item->precioventa}}</b></p>
                            </div>

                        </div>
                        <div class="card-action">
                            <form>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <select id="first_name{{$item->codigo}}" class="validate">
                                            @foreach ($item->inventarioproducto as $temptalla)
                                            @if ($temptalla->disponible > 0)
                                            @if ($temptalla->talla->idtalla == 1)
                                            <option value="{{$temptalla->talla->idtalla}}" selected>{{$temptalla->talla->medida}}</option>
                                            @else
                                            <option value="{{$temptalla->talla->idtalla}}">{{$temptalla->talla->medida}}</option>
                                            @endif

                                            @endif
                                            @endforeach
                                        </select>
                                        <label for="first_name{{$item->codigo}}">Talla</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input id="last_name{{$item->codigo}}" type="number" min="1" class="validate" value="1">
                                        <label for="last_name{{$item->codigo}}">Cantidad</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <a class="btn-floating btn-large waves-effect orange darken-2"><i class="material-icons">add</i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div>
                {{ $productos->links() }}
            </div>
        </div>
    </div>
</main>
@extends('layout.footer')
@section('scripts')
<script src="{{ asset('/js/galeria.js') }}"></script>
@endsection