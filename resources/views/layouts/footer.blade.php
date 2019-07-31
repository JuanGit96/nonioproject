<!-- Pie de pagina -->
<footer>
@if(!Auth::user()) 
<section class="footer">
    <div class="container pt-4">
        <div class="row">
            <div class="col lineas-footer pr-0">
                <h4>Nonio</h4>
                <a href="{{url('/preguntas_frecuentes')}}"><p class="m-0">Preguntas frecuentes</p></a>
                <a href="{{url('/terminos_condiciones')}}"><p>Términos y condiciones</p></a>
                
            </div>
            <div class="col" align="center">
                <a href="{{url('/contacto')}}"><h4>contáctanos</h4></a>
                {{--<p class="m-0">(+57) 311-2780248</p>--}}
                <p>contacto@nonio.co</p>
            </div>
            <div class="col text-right" >
                <p>&copy; 2018 Copyright Nonio. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</section>
<!-- Pie -->
@else
<!-- Pie -->
<section class="footer">
    <div class="container pt-4">
        <div class="row">
            <div class="col">
                <h4>Nonio</h4>
                <a href="{{url('/preguntas_frecuentes')}}"><p class="m-0">Preguntas frecuentes</p></a>
                <a href="{{url('/terminos_condiciones')}}"><p>Términos y condiciones</p></a>
                
            </div>
            <div class="col" align="center">    
                <a href="{{url('/contacto')}}"><h4>contáctanos</h4></a>
                {{--<p class="m-0">(+57) 311-2780248</p>--}}
                <p>contacto@nonio.co</p>
            </div>
            <div class="col text-right" >
                <p>&copy; 2018 Copyright Nonio. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</section>
<!-- Fin pie de pagina -->
@endif()
</footer>

