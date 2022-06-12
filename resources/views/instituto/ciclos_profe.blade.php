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

<span>Ciclo {{ucfirst($ciclo_id)}}</span>

@stop

@section('div_derecho')

<div class="row prueba">

<div class="col col-md-2 col-lg-2 col-xl-2 ml-lg-auto mr-lg-auto ml-xl-auto mr-xl-auto my-5 py-5 mr-5 div_lista_alumno" style="width: 18rem;">

  <a class="ir_listado_alumnos" href="{{route('lista.alumnos',['ciclo' => $ciclo_id])}}"><img class="card-img-top img-fluid" src="{{asset('/img/listado_alumno.png')}}" alt="Listado de alumnos" title="Listado de alumnos">

    <div class="card-body">

      <p class="card-text card_cpro text-center">Listado de alumnos</p>

    </div></a>

  </div>

  <div class="col-lg-2 col-md-2  col-xl-2 ml-md-auto mr-md-auto ml-lg-auto mr-lg-auto ml-xl-auto mr-xl-auto my-5 py-5 mr-5 div_ciclos_modulos" style="width: 18rem;">

    <a class="ir_modulos_imparte" href="{{route('modulos.impartidos',['ciclo' => $ciclo_id])}}"><img class="card-img-top img-fluid" src="{{asset('/img/editar_.png')}}" alt="Modulos que impartes" title="Modulos que impartes">

      <div class="card-body">

        <p class="card-text card_cpro text-center mr-2">Módulos que impartes</p>

      </div></a>

    </div>

  </div>

      @stop
  