<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('/css/estilos.css')}}" />
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}" />
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>

    <title>Instituto</title>
  </head>
  <body>
    <div class="container-fluid contenedor">
      <div class="row"  style="display: flex;">
        <!-----------Contenedor izquierdo---------------->
        <div
          id="divIzquierdo"
          class="col-3 col-md-3 col-lg-3 col-xl-2 contenedor_izquierdo"
        >
       @yield('div_izquierdo')
        
        </div>
        <!----------End contenedor izquierdo------------->

        <!-----------Contenedor Header-------------------->
        <div
          id="divHeader"
          class="col-9 col-md-9 col-lg-9 col-xl-10 mr-0 ml-auto mr-md-0 ml-md-auto mr-lg-0 ml-lg-auto mr-xl-0 ml-xl-auto mb-5 contenedor_header"
        >
          <!----Aquí logo----->
          <img
            src="{{asset('/img/logo_2.png')}}"
            class="img-fluid mx-auto d-block rounded logo"
            alt="Logo ins cami de mar"
          />
          <!------------------->

          <!-------Aquí gestor usuarios---------->
          <div class="btn-group gestionar_usuarios float-right mr-5">
            @yield('div_header')
          </div>

          <!------------------------------------->
        </div>
        <!---------End Contenedor Header--------------------->

        <!-----------------------Subtitulo------------------>

        <div class="subtitulo col-6 col-md-6  col-xl-5  mr-auto ml-auto mr-md-auto ml-md-auto mr-lg-auto ml-lg-auto mr-xl-auto ml-xl-auto">
         @yield('subtitulo')
        </div>
        <!---------------------------------------------------->
        <!---------Contenedor Derecho------------------------->
        <div id="divDerecho" class="col-8 col-md-7 col-lg-8 col-xl-9  mr-3 ml-auto mr-md-5 ml-md-auto mr-lg-5 ml-lg-auto mr-xl-5 ml-xl-auto my-5 contenedor_derecho">
          @yield('div_derecho')
        </div>
       
        </div>
        <!-----------End Contenedor Derecho--------------------->
      </div>
    </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>

    <script src="{{asset('/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('/js/script.js')}}"></script>
    <script src="{{asset('/js/script_jquery.js')}}"></script>
  </body>
</html>
