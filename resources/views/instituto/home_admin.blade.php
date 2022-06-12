@extends('layouts.master_admin')
@section('div_header')
<div class="btn-group gestionarUser">
  <button type="button" class="btn btn-secondary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  @if(auth()->check())
  <h5>{{ucfirst(auth()->user()->nombre)}}</h5>
  @endif
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{route('fin_session')}}">Cerrar sesion</a>
  </div>
</div>
@stop
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

  