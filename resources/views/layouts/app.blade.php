<!DOCTYPE html>
<html lang="es">
     
<head>
    @section('head')
      @include('layouts.head')
    @show
</head>
<body data-spy="scroll" data-target="#navbar_horizontal">
    @section('header')
      @include('layouts.header')
    @show
    @if(Auth::user())
    <?php 

    $user = DB::table('role_users')->where('user_id',Auth::user()->id)->first(); ?>

        @if($user->role_id == 1 || $user->role_id == 2  || $user->role_id == 3 || $user->role_id == 4)
        <div id="main" class="row">
            <!-- sidebar content -->
            <div  class="col-md-2 p-0">
                @include('layouts.sidebar')
            </div>

            <!-- main content -->
            <div  class="col-md-10 content-right">
                @yield('content')
            </div>

        </div>
        @else
        @yield('content')
        @endif()
    @else
    @yield('content')
    @endif()
    @section('footer')
      @include('layouts.footer')
    @show
    @include('layouts.script')
    @yield('script')
    @include('sweet::alert')
</body>
</html>
