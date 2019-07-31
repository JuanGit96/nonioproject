@extends('layouts.app')
@section('content')

<!-- Banner -->
<section class="bannerwelcome" id="ejemplo">
    <div class="col p-0 bannersm">
        <img class = "banner img-fluid" src="{{asset('img/bannernoniosm.jpg')}}" alt="Logosm"  width="100%">
        <div class="col mr-lg-5  text-banner text-white ">
            <h1 class="mb-4 nonioh1 d-none d-lg-block d-xl-block d-md-block">NONIO</h1>
            <h1 class="mb-2">La fórmula de la financiación  efectiva.</h1>
            <p class="text-bannerp" >Encuentra los aliados financieros que necesitas  para tu empresa </p>
            <a href="{{url('/simulation')}}" class="btn btn-carousel mt-lg-3 mt-md-3 mt-xl-3">¡ Ingresa ya !</a>
        </div>
    </div>
    <div class="col p-0 bannerxl">
        <img class = "banner img-fluid" src="{{asset('img/bannernonio.png')}}" alt="Logoxl"  width="100%">
        <div class="col-lg-6  mr-lg-5  text-banner text-white ">
            <h1 class="mb-4 nonioh1">NONIO</h1>
            <h1 class="mb-2">La fórmula de la financiación  efectiva.</h1>
            <p class="text-bannerp" >Encuentra los aliados financieros que necesitas  para tu empresa </p>
            <a href="{{url('/simulation')}}" class="btn btn-carousel mt-lg-3 mt-md-3 mt-xl-3">¡ Ingresa ya !</a>
        </div>
    </div>
</section>
<!-- Fin banner -->

<!-- How works -->
<section class="howworks pb-5 d-none d-lg-block d-xl-block " id="howworks">
    <div class="row">
        <div class="col text-center pt-5 pb-5">
            <h3>¿Cómo funciona?</h3>
        </div>
    </div>
    <div class="row " >
        <div class="col">
            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                    <div class=" front"> 
                        <div class="row pb-4 fronttitle">
                            <div class="col-3">
                                <img src="{{asset('img/1.png')}}" alt="" width="100%">
                            </div>
                            <div class="col-9">
                                <h4>Ingresa unos pocos datos sobre tu empresa</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{asset('img/IngresaDatos.jpg.png')}}" alt="" width="60%">
                            </div>
                        </div>
                    </div>
                    <div class="back pt-5 ml-4 mr-4">
                        <div class="row">
                            <div class="col text-center">
                                <h5>Ingresa la información actual de tu empresa para simular tu capacidad de endeudamiento</h5>
                            </div>
                        </div>
                        <div class="backimg row pt-4">
                            <div class="col text-center">
                                <img src="{{asset('img/linea.png')}}" alt="" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                    <div class="front "> 
                        <div class=" row pb-2 fronttitledos">
                            <div class="col-3">
                                <img src="{{asset('img/2.png')}}" alt="" width="100%">
                            </div>
                            <div class="col-9">
                                <h4>Identifica la capacidad de endeudamiento de tu empresa.</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{asset('img/Endeudamiento.png')}}" alt="" width="60%">
                            </div>
                        </div>
                    </div>
                    <div class="back pt-5 ml-3 mr-3">
                        <div class="row">
                            <div class="col text-center">
                                <h5>Con los datos ingresados estimaremos la capacidad adicional de endeudamiento de tu empresa.</h5>
                            </div>
                        </div>
                        <div class="backimg row pt-4">
                            <div class="col text-center">
                                <img src="{{asset('img/linea.png')}}" alt="" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                    <div class="front "> 
                        <div class="row pb-4 fronttitle">
                            <div class="col-3">
                                <img src="{{asset('img/3.png')}}" alt="" width="100%">
                            </div>
                            <div class="col-9">
                                <h4>Analiza las ofertas de crédito a tu disposición.</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{asset('img/Opciones.png')}}" alt="" width="60%">
                            </div>
                        </div>
                    </div>
                    <div class="back pt-5 ml-3 mr-3">
                        <div class="row">
                            <div class="col text-center">
                                <h5>Selecciona la oferta que mejor se ajuste a tus necesidades.</h5>
                            </div>
                        </div>
                        <div class=" row pt-4">
                            <div class="col text-center">
                                <img src="{{asset('img/linea.png')}}" alt="" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                    <div class="front "> 
                         <div class="row pb-4 fronttitle">
                            <div class="col-3">
                                <img src="{{asset('img/4.png')}}" alt="" width="100%">
                            </div>
                            <div class="col-9">
                                <h4>Te ponemos en contacto con nuestros aliados</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{asset('img/Asesoramiento.png')}}" alt="" width="60%">
                            </div>
                        </div>
                    </div>
                    <div class="back pt-5 ml-3 mr-3 ">
                        <div class="row">
                            <div class="col text-center">
                                <h5>Enviamos tu solicitud al aliado que seleccionaste para que se ponga en contacto contigo y continúe el proceso de crédito.. </h5>
                            </div>
                        </div>
                        <div class=" row pt-2">
                            <div class="col text-center">
                                <img src="{{asset('img/linea.png')}}" alt="" width="50%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>          
</section>
<!-- fin howworks -->

<!-- seccion who are -->
<section class="whoare  p-0" id="whoare">
    <div class="container">
        <div class="row alinear ">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 pb-4 pt-4 text-center">
                <img src="{{asset('img/whoare.png')}}" alt="whoare"  class="img-responsive" width="90%">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 pt-lg-5 pt-xl-5 ">
                <div class="row pb-2 pt-3">
                    <h3>¿Quiénes Somos?</h3>
                </div>
                <div class="row" align="justify">
                    <p>NONIO es Un asesor ﬁnanciero virtual que apoya el crecimiento empresarial del país, en nuestra plataforma conectamos nuestros aliados ﬁnancieros con las pequeñas
                    y medianas empresas que requieren crédito de capital de trabajo, crédito para el pago de obligaciones ﬁnancieras o impuestos, compra o 
                    reposición de activos, ampliaciones y ensanches. Ayudamos a encontrar la opción de ﬁnanciamiento que más le conviene en función de las 
                    necesidades y objetivos de su empresa.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- fin seccion -->

<!-- seccion how we do -->
<section class="howdo container mb-5 p-0" id="howdo">
    <div class="row">
        <div class="col mt-5 mb-5" align="center">
            <h3>¿Cuál es nuestro valor agregado?</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="row"> 
                <div class="col mb-4" align="center">
                    <img src="{{asset('img/Estimacion-de-credito.png')}}" alt="estimacion"  class="img-responsive" width="60%">
                </div>
            </div>
            <div class="row pb-4">
                <div class="col pr-5 pl-5" align="center">
                    <h5>Estimación de crédito</h5>
                    <p>Estimación de crédito adicional para tu empresa</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col mb-4" align="center">
                    <img src="{{asset('img/linea.png')}}" alt="linea"  class="img-responsive" width="60%">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row"> 
                <div class="col mb-4" align="center">
                    <img src="{{asset('img/Recomendaciones-personalizadas.png')}}" alt="recomendaciones"  class="img-responsive" width="60%">
                </div>
            </div>
            <div class="row pb-4">
                <div class="col pr-3 pl-3" align="center">
                    <h5>Ranking de las ofertas de crédito</h5>
                    <p>Clasificamos las ofertas de crédito para que puedas escoger la mejor según tu necesidad.</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col" align="center">
                    <img src="{{asset('img/linea.png')}}" alt="linea"  class="img-responsive" width="60%">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row"> 
                <div class="col  mb-4" align="center">
                    <img src="{{asset('img/Red-de-aliados.png')}}" alt="red"  class="img-responsive" width="60%">
                </div>
            </div>
            <div class="row pb-4">
                <div class="col pr-2 pl-2 " align="center">
                    <h5>Acceso a una amplia red de aliados</h5>
                    <p>Al usar NONIO ponemos a tu disposición múltiples ofertas de crédito.</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col mb-4" align="center">
                    <img src="{{asset('img/linea.png')}}" alt="linea"  class="img-responsive" width="60%">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- fin seccion -->

@endsection()


