@include('layout.header', ['title' => 'Catálogo Camisas'])
@include('layout.menu')
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white">
            <div style="padding:20px;">
                <nav id="indices">
                    <div class="col s12 right">
                        <a href="{{route('catalogoCamisas')}}" class="breadcrumb">Inicio</a>
                        <a href="{{route('catalogoCamisas')}}" class="breadcrumb">Catálogo</a>
                    </div>
                </nav>
                <ul class="collapsible" id="colapsefiltros">
                    @if ($filtros != null)
                    <li class="active">
                        @else
                    <li>
                        @endif
                        <div class="collapsible-header center" style="padding:0px;border:none;">
                            <h5 id="titlecatalogo">
                                Catálogo de Camisas <label class="pointer"> Aplicar filtros</label>
                            </h5>
                        </div>
                        <div id="bus-filtro" class="collapsible-body">
                            <div class="row" style="margin-bottom:0px;">
                                <div class="col s12 m12 l4">
                                    <div class="input-field col s12 filtros">
                                        <input type="text" placeholder="Camisa color azul" id="fitrodescripcion" value="{{ isset($filtros['descripcion'])?$filtros['descripcion']: '' }}">
                                        <label>Descripción</label>
                                    </div>
                                </div>
                                <div class="col s12 m6 l4">
                                    <div class="input-field col s12 filtros">
                                        <select id="filtrocolor">
                                            <option value="Todos">Todos</option>
                                            @foreach ($select["color"] as $item)
                                            @if ($filtros['color'] == $item->color)
                                            <option value="{{$item->color}}" selected>{{$item->color}}</option>
                                            @else
                                            <option value="{{$item->color}}">{{$item->color}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <label>Filtrar por color</label>
                                    </div>
                                </div>
                                <div class="col s12 m6 l4">
                                    <div class="input-field col s12 filtros">
                                        <select id="filtromarca">
                                            <option value="Todos">Todos</option>
                                            @foreach ($select["marca"] as $item)
                                            @if ($filtros['marca'] == $item->marca)
                                            <option value="{{$item->marca}}" selected>{{$item->marca}}</option>
                                            @else
                                            <option value="{{$item->marca}}">{{$item->marca}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <label>Filtrar por marca</label>
                                    </div>
                                </div>
                                <div class="col m12 l7">
                                    <div class="row mb-0">
                                        <div class="col s12 m4 l3">
                                            <div class="input-field col s12 filtros center">
                                                <input type="number" id="input-min" class="center" value="{{ isset($filtros['min'])?$filtros['min']: '100' }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l6 center">
                                            <label>Filtrar por precio</label>
                                            <div class="input-field col s12 filtros">
                                                <div id="test-slider"></div>
                                            </div>
                                        </div>
                                        <div class="col s12 m4 l3">
                                            <div class="input-field col s12 filtros center">
                                                <input type="number" id="input-max" class="center" value="{{ isset($filtros['max'])?$filtros['max']: '1000' }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l3 right">
                                    <button class="btn waves-effect orange darken-2" type="button" id="Filtrar" style="margin-top:15px;width:100%;">BUSCAR
                                        <i class="material-icons right">search</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="row" style="padding:10px;">
                @if (count($productos) == 0)
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <p>No se encontraron resultados a tu busqueda.</p>
                    </div>
                </div>
                @endif
                @foreach ($productos as $item)
                <div class="col s12 m6 l4">
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
                                        <select id="talla{{$item->codigo}}" name="talla" class="validate">
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
                                        <label for="talla{{$item->codigo}}">Talla</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input id="cantidad{{$item->codigo}}" name="cantidad" type="number" min="1" class="validate" value="1">
                                        <label for="cantidad{{$item->codigo}}">Cantidad</label>
                                    </div>
                                    <div class="input-field col s4 center">
                                        <button class="btn-floating btn-large waves-effect orange darken-2" type="button" id="item-{{$item->codigo}}-{{$item->idproducto}}"
                                            onclick="getFormData(this);">
                                            <i class="material-icons">add</i>
                                        </button>
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
<script src="{{ asset('/js/neuslider.js') }}"></script>
@endsection