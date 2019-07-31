<!DOCTYPE html>
<html>
<head>
    <!-- meta de la aplicacion -->
    <meta charset="utf-8" />
    <meta name="description" content="Azif">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Titulo de aplicacion -->
    <title>Nonio</title>
    
    <!--tipos de letra  -->

    
    
    <!-- Estilos de la pagina-->
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/general.css')}}">

    <!-- Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css" integrity="sha256-CNwnGWPO03a1kOlAsGaH5g8P3dFaqFqqGFV/1nkX5OU=" crossorigin="anonymous" />
    
    
    <!-- scripts -->
    <script src="{{asset('js/fontawesome-all.js')}}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123144888-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-123144888-1');
    </script>

  </head>
</html>