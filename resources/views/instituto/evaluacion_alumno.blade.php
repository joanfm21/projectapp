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
<span>Evaluación alumno</span>
@stop
@section('div_derecho')
@if(session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif
<!------------Breadcrumb---------------->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('http://127.0.0.1:8000/ciclo_profesor?ciclo=' . $ciclo_id) }}">Volver</a></li>
    <li class="breadcrumb-item"><a href="{{ url('http://127.0.0.1:8000/listado_alumnos?ciclo=' . $ciclo_id) }}">Listado de alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Evaluación alumno</li>
  </ol>
</nav>
<!--------------------------------------------->

@if($alumno->id == $id)
<div class="card alumno_notas col col-lg-4 col-xl-6 mr-xl-auto ml-xl-auto text-center">
  <div class="card-body">
    <h2 class="text-center">Evaluación del alumno</h2>
    <h4 class="text-center">Estudiante: {{ucfirst($alumno->nombre)}} {{ucfirst($alumno->apellido)}}</h4>
    <h5 class="text-center">Ciclo: {{ucfirst($alumno->ciclo)}}</h5>
  </div>
</div>
@endif
<form class="enviar_notas_alumno" method="get" action="{{route('notas.alumno')}}">
  @csrf
  @method('get')
  <!-------------------Table---------------------->
<a class="btn_mas_info" title="Más información"><svg class="question" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M10.97 8.265a1.45 1.45 0 00-.487.57.75.75 0 01-1.341-.67c.2-.402.513-.826.997-1.148C10.627 6.69 11.244 6.5 12 6.5c.658 0 1.369.195 1.934.619a2.45 2.45 0 011.004 2.006c0 1.033-.513 1.72-1.027 2.215-.19.183-.399.358-.579.508l-.147.123a4.329 4.329 0 00-.435.409v1.37a.75.75 0 11-1.5 0v-1.473c0-.237.067-.504.247-.736.22-.28.486-.517.718-.714l.183-.153.001-.001c.172-.143.324-.27.47-.412.368-.355.569-.676.569-1.136a.953.953 0 00-.404-.806C12.766 8.118 12.384 8 12 8c-.494 0-.814.121-1.03.265zM13 17a1 1 0 11-2 0 1 1 0 012 0z"></path><path fill-rule="evenodd" d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11 11-4.925 11-11S18.075 1 12 1zM2.5 12a9.5 9.5 0 1119 0 9.5 9.5 0 01-19 0z"></path></svg></a>
<!------------Más información--------------------->
<div class="card mas_info h-50" style="width: 18rem;">
  <svg class="salir" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path></svg>
  <div class="card-body">
    <h5 class="card-title text-center"><b>Más información</b></h5>
    <br>
    <p class="card-text text-left"> En este apartado podrás gestionar las notas de un alumno y sus respectivas ufs.</p>
    <p class="card-text text-left"><img class="mp" src="{{asset('/img/modulo_pertenece.png')}}" alt="Modulo pertenece"> Este color indica los módulos en el que estás asignado.</p>
    <p class="card-text text-left"><img class="mp" src="{{asset('/img/uf_pertenece.png')}}" alt="Uf pertenece"> Este color indica los módulos en el que no estás asignado, por lo cual no podrás editar sus ufs.</p>
    <p class="card-text text-left"> Si das click sobre algún registro de cualificación, podrás editarlo.</p>
  </div>
</div>
<!------------------------------------>

<div class="table-responsive">
<table class="table table-hover ">
  <thead>
  <tr>
      <th class="text-center">Módulo Uf</th>

      <th class="text-center">Descripción</th>
      <th class="text-center">Horas</th>
      <th class="text-center">Cualificación</th>
      <th class="text-center">Comentario</th>
    </tr>
  </thead>
  <tbody>
    @php $contador = 0;
          $contador2 = 0;
    @endphp

    @foreach($modulos as $ky => $modulo)
    @if($modulo->ciclo == $ciclo_id)
    @if(auth()->user()->id == $modulo->usuario_id)
    <tr class="listado_modulo_notas bg-secondary text-white">  
      @else
      <tr class="listado_modulo_notas bg-info">
      @endif
      <th class="text-center" scope="row">{{ucfirst($modulo->modulo)}}</th>
      <td class="text-center">{{ucfirst($modulo->descripcion_modulo)}}</td>
      <td class="text-center">{{$consulta[$contador++]->horas_totales}}</td>
      <td class="text-center">{{$nota_final[$contador2++]->notas}}</td>
      @if($modulo->comentarios==null)
      <td class="text-center">
        @if($modulo->usuario_id==Auth()->user()->id)
        <img class="comentario img-fluid" data-toggle="modal" height="60px" data-target="#exampleModal" onclick="setcomentarioid('{{$modulo->id}}')" src="{{asset('/img/comentario.png')}}"> 
        @else
        @endif
      </td>
      @else
      @if($modulo->usuario_id==Auth()->user()->id)
      <td class="text-center"> <img class="comentario img-fluid" data-toggle="modal" height="60px" data-target="#exampleModal" onclick="setcomentario('{{$modulo->id}}','{{$modulo->comentarios}}')" src="{{asset('/img/ver.png')}}"></td>
      @else
      <td class="text-center"> <img class="comentario img-fluid" data-toggle="modal" height="60px" data-target="#exampleModal1" onclick="setcomentario('{{$modulo->id}}','{{$modulo->comentarios}}')" src="{{asset('/img/ver.png')}}"></td>
      @endif
      @endif
      @foreach($uf as $key => $ufs_obtenidas)
      @if($ufs_obtenidas->modulo_id == $modulo->id)
      <tr class="listado_uf_notas">
        <th class="text-center" scope="row">{{ucfirst($ufs_obtenidas->nombre)}}</th>
        <td class="text-center">{{ucfirst($ufs_obtenidas->descripcion)}}</td>
        <td class="text-center">{{$ufs_obtenidas->horas}}</td>
        @foreach($nota as $key => $p)
        @if($ufs_obtenidas->id == $p->uf_id)
        <input value="{{$p->id}}" name="new_notas[]" hidden>
        <td class="text-center nota_alumno">
        @if(auth()->user()->id == $modulo->usuario_id)
        <input type="number" class="cualificacion" value="{{$p->cualificacion}}" style="width: 8rem;text-align: center;" title="Hacer click para modificar la nota" onClick="actualizar_nota({{$p->id}})" min="1" max="10">
        @else
        <span>{{$p->cualificacion}}</span>
        @endif
        </td>
        <td class="text-center comentario">---</td>
        @endif
        @endforeach
      </tr>
      @endif
      @endforeach
      @endif
      @endforeach
    </tr> 

    <button type="submit" class="btnGuardar btn btn-secondary my-2 py-2" id="btnGuardarN" name="btnGuardar" value="Guardar">Guardar</button>
  </tbody>
  </table>
  <!-- AGREGAMOS BOTON PARA EXPORTAR A PDF  -->
  <a  class="btnEnviarPdf btn btn-secondary my-2 py-2 text-white" href="{{route('exportar_notas_pdf.alumno', ['id' => $alumno->id])}}">Exportar a pdf</a>

  <a  class="btnEnviarPdf btn btn-secondary my-2 py-2 text-white" href="{{route('exportar_notas_email.alumno', ['id' => $alumno->id])}}">Enviar notas a correo</a>
  <!-- //////////////// -->
</div>
</form>
<!-- -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  action="{{route('comentar.modulo')}}" method="POST">
        @csrf
      <div class="modal-body">
          <input type="hidden" id="idcomentario" name="idcomentario">
          <textarea rows="10" id="comentario" name="comentario" class="form-control"></textarea>  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guradar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DE COMENTARIOS -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
        <textarea readonly rows="10" id="comentarioread" class="form-control"></textarea>   
      </div>
    </div>
  </div>
</div>
<!-- 
<script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
  function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
  }    

  docReady(() => {
    document.getElementById('comentarioread').ckeditor()
  })()
</script> -->
<script>
  function setcomentarioid(id){
    document.getElementById("idcomentario").value=id;
    document.getElementById("comentario").value="";
  }
  function setcomentario(id,comentario){
    document.getElementById("comentario").value="";
    document.getElementById("comentarioread").value="";

    document.getElementById("idcomentario").value=id;
    document.getElementById("comentario").value=comentario;
    document.getElementById("comentarioread").value=comentario;
  }
  
</script>
 <!-- -->  
@stop

  