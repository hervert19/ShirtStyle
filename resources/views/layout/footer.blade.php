<div class="fixed-action-btn">
    <a class="btn-floating btn-large green lighten-1">
        <i class="fas fa-share-alt"></i>
    </a>
    <ul>
        <li><a class="btn-floating red"><i class="fab fa-pinterest"></i></a></li>
        <li><a class="btn-floating pink darken-1"><i class="fab fa-instagram"></i></a></li>
        <li><a class="btn-floating green"><i class="fab fa-whatsapp"></i></a></li>
        <li><a class="btn-floating blue"><i class="fab fa-facebook"></i></a></li>
    </ul>
</div>
<footer class="page-footer green lighten-1">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <p class="white-text mb-0 mt-0"><b>¿Quiénes somos?</b></p>
                <label class="grey-text text-lighten-4" style="line-height: 1;font-size: .9rem;">
                    {{$empresa->descripcion}}
                </label>
                <p class="white-text mb-0 mt-0"><b>Estamos Ubicados</b></p>
                <label class="grey-text text-lighten-4" style="line-height: 1;font-size: .9rem;">
                    {{$empresa->direccion}}
                </label>
            </div>
            <div class="col l4 offset-l2 s12">
                <ul>
                    <li><a class="grey-text text-lighten-3"><b>Teléfonos</b> {{$empresa->telefono1}} y {{$empresa->telefono2}}</a></li>
                    <li><a class="grey-text text-lighten-3"><b>Email</b> {{$empresa->correo}}</a></li>
                    <li><a class="grey-text text-lighten-3"><b>Aceptamos</b></a></li>
                    <li>
                        <a class="grey-text text-lighten-3">
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
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © {{$empresa->nombre}}. Todos los derechos reservados (2020)
            <a class="grey-text text-lighten-4 right" href="#!">Terminos y Condiciones</a>
        </div>
    </div>
</footer>
<script src="{{ asset('/js/default/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('/js/default/materialize.min.js') }}"></script>
<script src="{{ asset('/js/default/nouislider.js') }}"></script>

@yield('scripts')
</body>

</html>