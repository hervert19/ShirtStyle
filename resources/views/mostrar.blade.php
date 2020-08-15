@include('layout.header', ['title' => 'Caballero'])
@include('layout.menu')
<main>
    <div class="layout-gallery gallery-top">
        <div class="card bg-white">
            <div class="row">
                <div class="col s12 m12">
                    <div class="carousel">
                        <a class="carousel-item" href="#one!"><img src="{{ asset('/img/shirt/Modelo-H1/H1-1.jpg') }}" class="materialboxed" width="250"></a>
                        <a class="carousel-item" href="#two!"><img src="{{ asset('/img/shirt/Modelo-H1/H1-2.jpg') }}" class="materialboxed" width="250"></a>
                        <a class="carousel-item" href="#three!"><img src="{{ asset('/img/shirt/Modelo-H1/H1-3.jpg') }}" class="materialboxed" width="250"></a>
                        <a class="carousel-item" href="#four!"><img src="{{ asset('/img/shirt/Modelo-H1/H1-4.jpg') }}" class="materialboxed" width="250"></a>
                        <a class="carousel-item" href="#five!"><img src="{{ asset('/img/shirt/Modelo-H1/H1-5.jpg') }}" class="materialboxed" width="250"></a>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Card Title</span>
                    <p>I am a very simple card. I am good at containing small bits of information.
                        I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action">
                    <a href="#">This is a link</a>
                    <a href="#">This is a link</a>
                </div>
            </div>
        </div>
    </div>
</main>
@extends('layout.footer')
@section('scripts')
@endsection