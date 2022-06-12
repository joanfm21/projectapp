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
  
  <a href="{{route('CrearCiclos')}}" type="button" class="btn btn-outline-secondary btn_ciclos btn-sm">Ciclos</a>

  <a href="{{route('registrar.modulos')}}" type="button" class="btn btn-outline-secondary btn_modulos btn-sm">Módulos</a>

  <a href="{{route('registrar.alumno')}}" type="button" class="btn btn-outline-secondary btn_alumnos btn-sm">Alumnos</a>

  <a href="{{route('registroUser')}}" type="button" class="btn btn-outline-secondary btn_profesores btn-sm">Profesores</a>

  <a href="{{route('registroAdmin')}}" type="button" class="btn btn-outline-secondary btn_admin btn-sm">Admin</a>
  <!--------------------------------------------------------------------------->
</div>
@stop
@section('subtitulo')
<span>Gestionar Ufs</span>
@stop
@section('div_derecho')
@php 
$id = $_GET['id'];
$ciclo = $_GET['ciclo'];
@endphp
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
<a class="añadir_mas " href="#" >¿Deseas añadir más Ufs?</a>
<form class="enviar_datos_ufs" method="POST" action="{{route('actualizar.uf')}}">
  @csrf
  @method('POST')
<!------------Breadcrumb---------------->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Volver</a></li>
    <li class="breadcrumb-item"><a href="{{route('registrar.modulos')}}">Módulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Uf</li>
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
    <p class="card-text text-left"> En este apartado podrás crear y editar ufs.</p>
    <p class="card-text text-left"> Si das click en: <i>"¿Deseas añadir más ufs?"</i> abrirá una ventana emergente con un formulario para poder añadir otra uf.</p>
  </div>
</div>
<!------------------------------------>
<div class="table-responsive">
<table class="table table-hover table-striped">
  <thead>
    <tr>
      <th class="text-center" scope="col">Nombre</th>
      <th class="text-center" scope="col">Descripción</th>
      <th class="text-center" scope="col">Horas</th>
      <th class="text-center" scope="col">Acción</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="tbody_mostrar">
   
    @foreach($ufs as $key => $uf) 
    @if($uf->modulo_id == $id)
    <tr class="listado_uf">
      <td class="text-center nombre_uf">{{ucfirst($uf->nombre)}}</td>
      <td class="text-center descrip_uf">{{ucfirst($uf->descripcion)}}</td>
      <td class="text-center horas_uf">{{$uf->horas}}</td>
      <td class="text-center" colspan="2"><a title="Actualizar datos de la uf" class="modificar_uf" href="#" onClick="actualizar_uf({{$uf->id}})"><img class="img_modi img-fluid" src="{{asset('/img/editar.png')}}" alt="editar"></a> <a title="Borrar uf"  class=" borrar_registro" href="{{route('delete.uf',['id' => $uf->id])}}"><img class="img_modi img-fluid" src="{{asset('/img/eraser.png')}}" alt="borrar"></a></td>
      <td></td>
  </tr>
  <input hidden value="{{$uf->id}}" name="new_ufs[]">
  @endif
  @endforeach
</tbody>
<button type="submit" class="btnGuardar btn btn-secondary my-2 py-2" id="btnGuardar" name="btnGuardar" value="Guardar">Guardar</button>
</table>
</div> 
</form>
<div class="popup-wrapper">
  <div class="popup">
      <div class="popup-close">x</div>
      <div class="popup-content">
<form class="mostrar_form" method="POST" action="{{route('subir.uf')}}">
    @csrf
    @method('POST')
    <input hidden value="{{$id}}" name="modulo_id" />
  
    <h1 class="title_r_uf ml-xl-auto mr-xl-auto my-xl-5">Añadir Uf</h1>
      <div class="form-group row col-xl-9 mr-xl-5 ml-xl-auto">
      <label for="nombre_uf" class="col-sm-2 col-form-label">
        Nombre:
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control py-2 my-2" id="nombre_uf" name="nombre_uf" placeholder="Introduce el nombre de la uf" value="{{old('nombre_uf')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
      <label for="descrip_uf" class="col-sm-2 col-form-label">
        Descripción:
      </label>
      <div class="form-group row col-lg-9 mr-lg-4 ml-lg-auto col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="text" class="form-control py-2 my-2" id="descrip_uf" name="descrip_uf" placeholder="Introduce la descripción de la uf" value="{{old('descrip_uf')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 mr-lg-0 ml-lg-0 col-xl-9 mr-xl-5 ml-xl-auto">
      <label for="horas_uf" class="col-sm-2 col-form-label">
        Horas:
      </label>
      <div class="form-group row col-lg-9 mr-lg-4 ml-lg-auto col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="number" class="form-control py-2 my-2" id="horas_uf" name="horas_uf" placeholder="Introduce las horas de la uf" value="{{old('horas_uf')}}" style="width: 28rem;" min="10" max="60" aria-describedby="passwordHelpBlock" required>
        <small id="passwordHelpBlock" class="form-text text-muted">
          Las horas introducidas de la uf tienen que estar entre 10 y 60
        </small>
      </div>
    </div>
    <input value="{{$ciclo}}" name="ciclo" hidden>
    <button type="submit" class="boton btn btn-secondary my-5" id="btnEnviar" name="enviar">Enviar</button>
  </form>
</div>
</div>
</div>
@stop