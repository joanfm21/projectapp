@extends('layouts.master_admin')

@section('div_header')

<button type="button" class="btn btn-link dropdown-toggle btn_gestion_user mt-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

  @if(auth()->check())

  {{ucfirst(auth()->user()->nombre)}}

  @endif

</button>

<div class="dropdown-menu">

  <a class="dropdown-item" href="{{route('fin_session')}}">Cerrar sesion</a>

</div>



<!------------------------Logout Pantallas pequeñas-------------------------------->

<link rel="stylesheet" href="{{asset('/css/responsiv.css')}}" />

@if(auth()->check())

  <span class="nlg_admin mt-4">{{ucfirst(auth()->user()->nombre)}}</span>

  @endif

  <a href="{{route('fin_session')}}" class="ic_salir" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M2 2.75C2 1.784 2.784 1 3.75 1h2.5a.75.75 0 010 1.5h-2.5a.25.25 0 00-.25.25v10.5c0 .138.112.25.25.25h2.5a.75.75 0 010 1.5h-2.5A1.75 1.75 0 012 13.25V2.75zm10.44 4.5H6.75a.75.75 0 000 1.5h5.69l-1.97 1.97a.75.75 0 101.06 1.06l3.25-3.25a.75.75 0 000-1.06l-3.25-3.25a.75.75 0 10-1.06 1.06l1.97 1.97z"></path></svg></a>

<!------------------------------------------------------------------------->

<!---------------Menu pantallas pequeñas--------------------->

<div class="dropdown new_menu  ">

  <button class="btn  btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

   <span class="menu_title">Gestionar</span>

  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <a href="{{route('CrearCiclos')}}" type="button" class="dropdown-item">Ciclos</a>



    <a href="{{route('registrar.modulos')}}" type="button" class="dropdown-item">Módulos</a>

  

    <a href="{{route('registrar.alumno')}}" type="button" class="dropdown-item">Alumnos</a>

  

    <a href="{{route('registroUser')}}" type="button" class="dropdown-item">Profesores</a>

  

    <a href="{{route('registroAdmin')}}" type="button" class="dropdown-item">Admin</a>

  </div>

</div> 

<!------------------------------------>

@stop

@section('div_izquierdo')

<div class="row div_izquierdo_menu">

  <img class="img_dash img-fluid" src="{{asset('/img/dashboard.png')}}" alt="dashboard"><h3 class="dashboard">Dashboard <hr class="linea"></h3>



  <!---------------------------Menú--------------------------------------------->

  <h5 class="titulo text-left"><img class="img-fluid img_gest_menu" src="{{asset('/img/gestionarr.png')}}" alt="gestionar"> Gestionar</h5>

  

  <a href="{{route('CrearCiclos')}}" type="button" class="btn btn-outline-secondary btn_ciclos btn-sm">Ciclos</a>



  <a href="{{route('registrar.modulos')}}" type="button" class="btn btn-outline-secondary btn_modulos btn-sm">Módulos</a>



  <a href="{{route('registrar.alumno')}}" type="button" class="btn btn-outline-secondary btn_alumnos btn-sm">Alumnos</a>



  <a href="{{route('registroUser')}}" type="button" class="btn btn-outline-secondary btn_profesores btn-sm">Profesores</a>



  <a href="{{route('registroAdmin')}}" type="button" class="btn btn-outline-secondary btn_admin btn-sm">Admin</a>

  <!--------------------------------------------------------------------------->

</div>

@stop

@section('subtitulo')

<span class="sub">Gestionar ciclos</span>

@stop

@section('div_derecho')

@if(session('mensaje'))

<div class="alert alert-success">

  {{session('mensaje')}}

</div>

@endif

@if(session('correoOcupado'))

<div class="alert alert-danger">

  {{session('correoOcupado')}}

</div>

@endif

<a class="añadir_mas " href="#" >¿Deseas añadir más ciclos?</a>

<form class="enviar_datos_ciclos" method="POST" action="{{route('actualizar.ciclo')}}">

  @csrf

  @method('POST')

<!------------Breadcrumb---------------->

<nav aria-label="breadcrumb" class="col-6">

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="#">Volver</a></li>

    <li class="breadcrumb-item active" aria-current="page">Ciclos</li>

  </ol>

</nav>

<!--------------------------------------------->

<!-------------------Table---------------------->

<a class="btn_mas_info" title="Más información"><svg class="question" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M10.97 8.265a1.45 1.45 0 00-.487.57.75.75 0 01-1.341-.67c.2-.402.513-.826.997-1.148C10.627 6.69 11.244 6.5 12 6.5c.658 0 1.369.195 1.934.619a2.45 2.45 0 011.004 2.006c0 1.033-.513 1.72-1.027 2.215-.19.183-.399.358-.579.508l-.147.123a4.329 4.329 0 00-.435.409v1.37a.75.75 0 11-1.5 0v-1.473c0-.237.067-.504.247-.736.22-.28.486-.517.718-.714l.183-.153.001-.001c.172-.143.324-.27.47-.412.368-.355.569-.676.569-1.136a.953.953 0 00-.404-.806C12.766 8.118 12.384 8 12 8c-.494 0-.814.121-1.03.265zM13 17a1 1 0 11-2 0 1 1 0 012 0z"></path><path fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z"></path></svg></a>

<!------------Más información--------------------->

<div class="card mas_info h-50" style="width: 18rem;">

  <svg class="salir" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path></svg>

  <div class="card-body">

    <h5 class="card-title text-center"><b>Más información</b></h5>

    <br>

    <p class="card-text text-left"> En este apartado podrás crear y editar ciclos.</p>

    <p class="card-text text-left"> Si das click en: <i>"¿Deseas añadir más ciclos?"</i> abrirá una ventana emergente con un formulario para poder añadir otro ciclo.</p>

  </div>

</div> 

<!------------------------------------>

<div class="table-responsive">

<table class="table table-hover table-striped table_ciclos">

  <thead>

    <tr>

      <th class="text-center" scope="col">Ciclo</th>

      <th class="text-center" scope="col">Fecha inicio</th>

      <th class="text-center" scope="col">Fecha fin</th>

      <th class="text-center" scope="col">Acción</th>

    </tr>

  </thead>

  <tbody class="tbody_mostrar">

    @foreach($ciclos as $key => $ciclo)

    <tr class="listado_ciclo">

      <td class="text-center ciclo_n">{{ucfirst($ciclo->ciclo)}}</td>

      <td class="text-center periodo">{{ucfirst($ciclo->periodo)}}</td>

      <td class="text-center periodo_fin">{{ucfirst($ciclo->periodo_fin)}}</td>

      <td class="text-center"><a title="Actualizar datos del ciclo" class="modificar_ciclo" href="#" onClick="actualizar_ciclo({{$ciclo->id}})" ><img class="img_modi img-fluid" src="{{asset('/img/editar.png')}}" alt="editar"></a><span class="espacio mx-xl-2 mx-lg-2"></span><a title="Borrar ciclo"  class="borrar_registro" href="{{route('delete.ciclo',['id' => $ciclo->id])}}" ><img class="img_modi img-fluid" src="{{asset('/img/eraser.png')}}" alt="borrar"></a></td>

    </tr> 

    <input hidden value="{{$ciclo->id}}" name="new_ciclos[]">

    @endforeach

    <button type="submit" class="btnGuardarC btn btn-secondary my-2 py-2" id="btnGuardarC" name="btnGuardar" value="Guardar">Guardar</button>

  </tbody>

</table>

</div>

<!-----------------End table----------------------->

</form>

<div class="popup-wrapper">

  <div class="popup">

    <div class="popup-close my-5">x</div>

    <div class="popup-content">

      <form class="form_ciclo" method="POST" action="{{route('ciclos.datos')}}">

        @csrf

        @method('POST')

        <h1 class="title_r_ciclos mt-5 ml-xl-auto mr-xl-auto my-xl-5">Registrar Ciclos</h1>

        <div class="form-group row col-lg-7 col-xl-9 mt-5 mt-md-5 my-lg-5 mr-lg-auto ml-lg-auto mr-xl-5 ml-xl-auto">

          <label for="nombre" class="col-sm-2 col-form-label">

            <img class="img_accion img-fluid" src="{{asset('/img/educacion.png')}}" alt="Nombre">

          </label>

          <div class="col-sm-10 col-12">

            <input type="text" class="form-control py-2 my-2 col-12" id="nombre" name="nombre_ciclo" placeholder="Nombre del ciclo" value="{{old('nombre_ciclo')}}" style="width: 18rem;" required>

             {{ $errors->first('nombre_ciclo','<div class="alert alert-danger">:message</div>')}}

          </div>

        </div>

        <div class="form-group row date_ciclo_form col-lg-8 col-xl-10 my-lg-5 mr-lg-auto ml-lg-auto mr-xl-5 ml-xl-auto">

          <label for="fecha" class="col-sm-2 col-lg-5 col-form-label fechas"><img class="img_accion img-fluid" src="{{asset('/img/calendario.png')}}" alt="calendario">

           Inicio:</label>

          <div class="col-12 col-sm-10 col-lg-5 ini_fecha">

          <input type="month"class="col-12 form-control my-2 w-50 text-center" id="fecha" name="periodo" required>

        </div>

      </div>

      <div class="form-group row date_ciclo_form col-lg-8 col-xl-10 my-lg-5 mr-lg-auto ml-lg-auto mr-xl-5 ml-xl-auto">

        <label for="fecha_fin" class="col-sm-2 col-lg-5 col-form-label fechas"><img class="img_accion img-fluid" src="{{asset('/img/calendario.png')}}" alt="calendario">

        Fin:</label>

        <div class="col-sm-10 col-12 col-lg-5 fn_fecha">

          <input type="month"class=" col-12 form-control my-2 w-50 text-center" id="fecha_fin" name="periodo_fin" required>

    </div>

      </div>

      <button type="submit" class="boton btn_r_ciclos btn btn-secondary my-3" id="btnEnviar" name="enviar">Enviar</button>

    </form>

  </div>

</div>

</div>

@stop


