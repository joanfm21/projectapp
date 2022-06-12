@extends('layouts.master_admin')

@section('div_header')

@php

$ciclo_id = $_GET['ciclo'];

@endphp

<button type="button" class="btn btn-link dropdown-toggle btn_gestion_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

  @if(auth()->check())

  {{ucfirst(auth()->user()->nombre)}}

  @endif

</button>

<div class="dropdown-menu">

  <a class="dropdown-item" href="{{route('fin_session')}}">Cerrar sesion</a>

</div>

<link rel="stylesheet" href="{{asset('/css/estilos_profe.css')}}" />

@stop

@section('div_izquierdo')

<div class="row div_izquierdo_menu">

  <img class="img_dash img-fluid" src="{{asset('/img/dashboard.png')}}" alt="dashboard"><h3 class="dashboard">Dashboard <hr class="linea"></h3>



  <!---------------------------Menú--------------------------------------------->

  <h5 class="titulo text-left"><img class="img-fluid img_gest_menu" src="{{asset('/img/gestionarr.png')}}" alt="gestionar"> Gestionar</h5>

  <select class="custom-select w-50 my-3 mr-xl-5 ml-xl-5" id="profes_ciclo" name="select_ciclo" onchange="if (this.value) window.location.href=this.value">

    <option selected hidden>Ciclo</option>

    @foreach($ciclos as $key => $ciclo)

    <option value="{{route('ciclo.profesor',['ciclo' => $ciclo->ciclo])}}">{{ucfirst($ciclo->ciclo)}}</option>

    @endforeach

  </select>

<!--------------------------------------------------------------------------->

</div>

@stop

@section('subtitulo')

<span>Listado de alumnos</span>

@stop

@section('div_derecho')

<!------------Breadcrumb---------------->

<nav aria-label="breadcrumb">

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="{{ url()->previous()}}">Volver</a></li>

    <li class="breadcrumb-item active" aria-current="page">Listado de alumnos</li>

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

    <p class="card-text text-left"> En este apartado podrás ver los datos de un alumno y gestionar sus notas.</p>

    <p class="card-text text-left"> <img class="img_alumno img-fluid" src="{{asset('/img/datos_personales.png')}}" alt="Datos alumnos">Si das click aquí podrás ver los datos personales del alumno.</p>

    <p class="card-text text-left"><img class="img_alumno img-fluid" src="{{asset('/img/calificacion.png')}}" alt="Nota del alumno"></a></td> Si das click aquí podrás evaluar a este alumno de tus módulos.</p>

  </div>

</div>

<!------------------------------------>

<div class="table-responsive">

<table class="table table-hover table-striped table_alu_pro">

  <thead>

    <tr>

      <th class="text-center" scope="col" colspan="2">Nombre completo</th>

      <td></td>

      <th class="text-center" scope="col">Acción</th>

    </tr>

  </thead>

  <tbody class="tbody_mostrar">

    @foreach($alumnos as $key => $alumno)

    @if($alumno->ciclo == $ciclo_id)

    <tr class="listado_alumnos_profe">

      <td class="text-center" colspan="2">{{ucfirst($alumno->nombre)}} {{ucfirst($alumno->apellido)}}</td>  

      <td></td>

      <td  class="text-center"><a title="Datos personales del alumno" href="{{route('datosP.alumnos',['id' => $alumno->id,'ciclo' => $ciclo_id])}}"><img class="img_alumno img-fluid ml-5" src="{{asset('/img/datos_personales.png')}}" alt="Datos alumnos"></a><a title="Notas de los alumno" href="{{route('evaluacion.alumno',['id' => $alumno->id,'ciclo' => $ciclo_id])}}"><img class="img_alumno img-fluid mr-5 ml-4 rounded float-right" src="{{asset('/img/calificacion.png')}}" alt="Nota del alumno"></a></td>

    </tr>

    @endif 

    @endforeach

  

   

  </tbody>

</table>

@stop



  