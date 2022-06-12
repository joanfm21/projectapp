@extends('layouts.master_admin')

@section('div_header')

<button type="button" class="btn btn-link dropdown-toggle btn_gestion_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

  @if(auth()->check())

  {{ucfirst(auth()->user()->nombre)}}

  @endif

</button>

<div class="dropdown-menu">

  <a class="dropdown-item" href="{{route('fin_session')}}">Cerrar sesion</a>

</div>

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

<span>Datos Personales</span>

@stop

@section('div_derecho')

@php 

$id = $_GET['id'];

$ciclo = $_GET['ciclo'];

@endphp

<!------------Breadcrumb---------------->

<nav aria-label="breadcrumb">

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="{{ url('http://127.0.0.1:8000/ciclo_profesor?ciclo=' . $ciclo) }}">Volver</a></li>

    <li class="breadcrumb-item"><a href="{{ url('http://127.0.0.1:8000/listado_alumnos?ciclo=' . $ciclo) }}">Listado de alumnos</a></li>

    <li class="breadcrumb-item active" aria-current="page">Datos personales</li>

  </ol>

</nav>



@foreach($alumnos as $key => $alumno)

@if($alumno->id == $id && $alumno->ciclo == $ciclo)

<div class="row">

  <div class="card col col-lg-6 col-xl-4 my-xl-5 ml-xl-5 mr-lg-auto ml-lg-1 my-lg-3 card_alumnos">

  <div class="card-body">

    Correo electrónico: {{$alumno->correo}}

    <br><br>

    Fecha Nacimiento: {{ucfirst($alumno->fecha_nacimiento)}}

    <br><br>

    Número telefónico: {{$alumno->telefono}}

    <br><br>

    Dirección: {{ucfirst($alumno->direccion)}}

    <br><br>

    Dni: {{ucfirst($alumno->dni)}}

    <br><br>

    Código postal: {{$alumno->cp}}

  </div>

</div>

<div class="card col col-lg-4 col-xl-2 mr-xl-auto my-xl-5 ml-xl-auto datos_alumno h-25" style="width: 20rem;">

  <img class="card-img-top" src="{{asset('/img/card_alumno.jpg')}}" alt="Datos alumno">

  <div class="card-body">

    <h5 class="card-title text-center">{{ucfirst($alumno->nombre)}} {{ucfirst($alumno->apellido)}}</h5>

  </div>

</div>

</div>

@endif

@endforeach

</tbody>

</table>

@stop