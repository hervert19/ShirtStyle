@include('layout.header', ['title' => 'Caballero'])
@include('layout.menu')
        <main>
            <div class="layout-gallery gallery-top">
                <div class="card bg-white">
                    <div class="row" style="padding:10px;">
                        @for ($i = 0; $i < 12; $i++) <div class="col s12 m4">
                            <div class="card">

                                <div class="card-image">
                                    <img src="{{ asset('/img/shirt/Modelo-H1/H1-1.jpg') }}">
                                </div>
                                <div class="card-content">
                                    <p>Camisa para Caballero Manga Larga Azul a Cuadros Cavalatti</p>
                                    <p>$560</p>
                                </div>
                                <div class="card-action">
                                    <form>
                                        <div class="row">
                                            <div class="input-field col s4">
                                                <select id="first_name{{$i}}" class="validate">
                                                    <option value="CH">CH</option>
                                                    <option value="M">M</option>
                                                    <option value="G">G</option>
                                                    <option value="XG">XG</option>
                                                </select>
                                                <label for="first_name{{$i}}">Talla</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <input id="last_name{{$i}}" type="number" min="1" class="validate" value="1">
                                                <label for="last_name{{$i}}">Cantidad</label>
                                            </div>
                                            <div class="input-field col s4">
                                                <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>

                    @endfor
                </div>
            </div>
            </div>
        </main>
@extends('layout.footer')
@section('scripts')
@endsection