@extends('layouts.master_admin')
@section('content')

@if(session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>

@endif
@php 
$id = $_GET['id'];
@endphp

<a class="añadir_mas" href="#" >¿Deseas añadir más Ufs?</a>
<table class="table table-success ">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th class="text-center" scope="col">Descripción</th>
      <th class="horas_uf" scope="col">Horas</th>
      <th class="text-center" scope="col">Acción</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($ufs as $key => $uf)
    @if($uf->ciclo_id == $id)
    <tr>
      <td>{{$uf->nombre}}</td>
    
      <td>{{$uf->descripcion}}</td>
    
      <td>{{$uf->horas}}</td>
    
    <td><a class="accion" href="#"><img class="img_ac img_editar img_uf" src="{{asset('/img/editar.png')}}" alt="editar"></a> <a class="accion" href="#"><img class="img_ac img_borrar img_uf_borrar" src="{{asset('/img/eraser.png')}}" alt="borrar"></a></td>
    
<td></td>
</tr>
@endif
@endforeach
  </tbody>
</table>

<div class="popup-wrapper">
  <div class="popup">
      <div class="popup-close">x</div>
      <div class="popup-content">
<form class="mostrar_form" method="POST" action="{{route('subir.uf')}}">
    @csrf
    @method('POST')
    <input hidden value="{{$id}}" name="modulo_id" />

      <h1 class="registrar r_alumnos">Añadir Ufs</h1>
    <div class="form-group row">
      <label for="nombre_uf" class="col-sm-2 col-form-label">
        Nombre:
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control py-2 my-2 registrarUser nmbre" id="nombre_uf" name="nombre_uf" placeholder="Introduce el nombre de la uf" value="{{old('nombre_uf')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="descrip_uf" class="col-sm-2 col-form-label">
        Descripción:
      </label>
      <div class="col-sm-10">
        <input type="text" class="form-control py-2 my-2 registrarUser nmbre" id="descrip_uf" name="descrip_uf" placeholder="Introduce la descripción de la uf" value="{{old('descrip_uf')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="horas_uf" class="col-sm-2 col-form-label">
        Horas:
      </label>
      <div class="col-sm-10">
        <input type="number" class="form-control py-2 my-2 registrarUser nmbre" id="horas_uf" name="horas_uf" placeholder="Introduce las horas de la uf" value="{{old('horas_uf')}}" style="width: 28rem;" min="0" max="60" required>
      </div>
    </div>
    <button type="submit" class="boton botonAlumno btn btn-primary my-5" id="btnEnviar" name="enviar">Enviar</button>
  </form>
</div>
</div>
</div>
@endsection
@section('div_izquierdo')
<img class="gestionarAdmin img-fluid rounded float-left" src="./img/gestion-de-proyectos.png" alt="gestionar_admin">
<div class="btn-group gestionar">
  <button type="button" class="btn btn-secondary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Gestionar
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('CrearCiclos')}}">Ciclos</a>
    <a class="dropdown-item" href="{{route('registrar.modulos')}}">Modulos</a>
    <a class="dropdown-item" href="{{route('registrar.alumno')}}">Alumnos</a>
    <a class="dropdown-item" href="{{route('registroUser')}}">Profesores</a>
    <a class="dropdown-item" href="{{route('registroAdmin')}}">Admin</a>
  </div>
</div>
      @stop
      @section('div_header')
      <div class="btn-group gestionarUser">
        <button type="button" class="btn btn-secondary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(auth()->check())
        <h5>{{auth()->user()->nombre}}</h5>
        @endif
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('fin_session')}}">Cerrar sesion</a>
        </div>
      </div>
      @stop