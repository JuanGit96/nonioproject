@extends('layouts.app')
@section('content')
<!-- Vista de no aceptado -->
<section class="sorry">
    <div class="row">
        <div class="col mt-4 mb-4" align="center">
            <h1>¡ Lo sentimos !</h1>
        </div>
    </div>
    <div class="row">
        <div class="col mt-2 mb-5" align="center">
            <img src="{{asset('img/advertencia.png')}}" alt="">
        </div>
    </div>
    <div class="row">
        <div class="text-accepted col mt-1 mb-5 " align="center">
            <h4>{{$info}}</h4>
        </div>
    </div>
    {{--@if($btn)--}}
        {{--<div class="row">--}}
            {{--<div class="col mb-5 " align="center">--}}
                {{--<button class="btn btn-carousel">Quiero Asesoramiento</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endif--}}
</section>
@endsection()
