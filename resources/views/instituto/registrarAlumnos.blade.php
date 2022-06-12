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
<span>Gestionar Alumnos</span>
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
@if(session('correoInvalido'))
<div class="alert alert-danger">
  {{session('correoInvalido')}}
</div>
@endif
@if(session('correoInvalido'))
<div class="alert alert-danger">
  {{session('correoInvalido')}}
</div>
@endif
@if(session('dniInvalido'))
<div class="alert alert-danger">
  {{session('dniInvalido')}}
</div>
@endif
@if(session('cpInvalido'))
<div class="alert alert-danger">
  {{session('cpInvalido')}}
</div>
@endif
@if(session('telefono_invalido'))
<div class="alert alert-danger">
  {{session('telefono_invalido')}}
</div>
@endif
<a class="añadir_mas " href="#" >¿Deseas añadir más Alumnos?</a>
<form class="enviar_datos_alumno" method="POST" action="{{route('actualizar.alumno')}}">
  @csrf
  @method('POST')
<!------------Breadcrumb---------------->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Volver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
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
    <p class="card-text text-left"> En este apartado podrás registrar y editar alumnos.</p>
    <p class="card-text text-left"> Si das click en: <i>"¿Deseas añadir más alumnos?"</i> abrirá una ventana emergente con un formulario para poder añadir otro alumno.</p></p>
  </div>
</div>
<!------------------------------------>
<div class="table-responsive alumno_t">
<table class="table table-hover table-striped ">
  <thead>
    <tr>
      <th class="text-center" scope="col">Dni</th>
      <th class="text-center" scope="col">Nombre</th>
      <th class="text-center" scope="col">Apellido</th>
      <th class="text-center" scope="col">Dirección</th>
      <th class="text-center" scope="col">Teléfono</th>
      <th class="text-center" scope="col">Cp</th>
      <th class="text-center" scope="col">Fecha Nacimineto</th>
      <th class="text-center" scope="col">Correo</th>
      <th class="text-center" scope="col">Ciclo</th>
      <th scope="col">Acción</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="tbody_mostrar">
    @foreach($alumnos as $key => $alumno)
    <tr class="listado_alumno">
      <td class="text-center alumno_dni">{{ucfirst($alumno->dni)}}</td>
      <td class="text-center alumno_nombre">{{ucfirst($alumno->nombre)}}</td>
      <td class="text-center alumno_apellido">{{ucfirst($alumno->apellido)}}</td>
      <td class="text-center alumno_direc">{{ucfirst($alumno->direccion)}}</td>
      <td class="text-center alumno_telef">{{ucfirst($alumno->telefono)}}</td>
      <td class="text-center alumno_cp">{{ucfirst($alumno->cp)}}</td>
      <td class="text-center alumno_fecha">{{ucfirst($alumno->fecha_nacimiento)}}</td>
      <td class="text-center alumno_correo" rowspan="1">{{$alumno->correo}}</td>
      <td class="text-center alumno_ciclo">{{ucfirst($alumno->ciclo)}}</td>
      <td  class="text-center" colspan="2"><a title="Actualizar datos del alumno" class="modificar_alumno" href="#" onClick="actualizar_alumnos({{$alumno->id}},{{$ciclos}})"><img class="img_modi img-fluid" src="{{asset('/img/editar.png')}}" alt="editar"></a> <a title="Borrar alumno" class="borrar_registro" href="{{route('delete.alumno',['id' => $alumno->id])}}"><img class="img_modi img-fluid" src="{{asset('/img/eraser.png')}}" alt="borrar"></a></td>
  <td></td>
</tr>
<input hidden value="{{$alumno->id}}" name="new_alumnos[]">
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
<form class="mostrar_form" method="POST" action="{{route('subir.alumno')}}">
    @csrf
    @method('POST')
    <h1 class="title_r_profe ml-xl-auto mr-xl-auto my-xl-5">Añadir Alumnos</h1>
      <label for="alumno_ciclo" class="col-sm-2 col-form-label">
        Asignar ciclo
      </label>
      <select class="custom-select w-50" id="alumno_ciclo" name="select_ciclo">
        @foreach($ciclos as $key => $ciclo)
        <option value="{{$ciclo->id}}">{{ucfirst($ciclo->ciclo)}}</option> 
        @endforeach
      </select>
      <div class="form-group row col-lg-9 col-xl-10 my-xl-2  mr-xl-2 ml-xl-auto">
      <label for="alumno_dni" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/dni.png')}}" alt="alumno_dni">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="text" class="form-control py-2 my-2" id="alumno_dni" name="alumno_dni" placeholder="Introduce el dni del alumno" value="{{old('alumno_dni')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_nombre" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/user.png')}}" alt="alumno_nombre">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="text" class="form-control py-2 my-2 " id="alumno_nombre" name="alumno_nombre" placeholder="Introduce el nombre del alumno" value="{{old('alumno_nombre')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_apellido" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/user.png')}}" alt="alumno_apellido">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="text" class="form-control py-2 my-2" id="alumno_apellido" name="alumno_apellido" placeholder="Introduce el apellido del alumno" value="{{old('alumno_apellido')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_dire" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/mapa.png')}}" alt="alumno_dire"/>
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="text" class="form-control py-2 my-2" id="alumno_dire" name="alumno_dire" placeholder="Introduce la dirección del alumno" value="{{old('alumno_dire')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_telef" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/llamada-telefonica_.png')}}" alt="alumno_telef">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="number" class="form-control py-2 my-2" id="alumno_telef" name="alumno_telef" placeholder="Introduce el teléfono del alumno" value="{{old('alumno_telef')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_cp" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/codigo-postal_.png')}}" alt="alumno_cp">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="number" class="form-control py-2 my-2" id="alumno_cp" name="alumno_cp" placeholder="Introduce el cp del alumno" value="{{old('alumno_cp')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_fecha" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/calendario.png')}}" alt="alumno_fecha">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="date" class="form-control py-2 my-2" id="alumno_fecha" name="alumno_fecha" placeholder="Fecha de nacimiento: 1999-27-06" value="{{old('alumno_fecha')}}" style="width: 28rem;" required>
      </div>
    </div>
    <div class="form-group row col-lg-9 col-xl-10 my-xl-2 mr-xl-2 ml-xl-auto">
      <label for="alumno_correo" class="col-sm-2 col-form-label">
      <img class="img_accion img-fluid" src="{{asset('/img/correo.png')}}" alt="alumno_correo">
      </label>
      <div class="col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
        <input type="email" class="form-control py-2 my-2" id="alumno_correo" name="alumno_correo" placeholder="Introduce el correo del alumno" value="{{old('alumno_correo')}}" style="width: 28rem;" required>
      </div>
    </div>
    <button type="submit" class="boton btn btn-secondary my-5" id="btnEnviar" name="enviar">Enviar</button>
  </form>
</div>
</div>
</div>
@stop