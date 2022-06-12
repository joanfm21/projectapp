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
<span>Gestionar Admin</span>
@stop
@section('div_derecho')
@if(session('correoInvalido'))
<div class="alert alert-danger">
  {{session('correoInvalido')}}
</div>
@endif
@if(session('passwordInvalido'))
<div class="alert alert-danger">
  {{session('passwordInvalido')}}
</div>
@endif
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
<a class="añadir_mas " href="#" >¿Deseas añadir más Admin?</a>
<form class="enviar_datos_admin" method="POST" action="{{route('actualizar.admin')}}">
  @csrf
  @method('POST')
<!------------Breadcrumb---------------->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Volver</a></li>
    <li class="breadcrumb-item active" aria-current="page">Admin</li>
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
    <p class="card-text text-left"> En este apartado podrás registrar y editar Admin.</p>
    <p class="card-text text-left"> Si das click en: <i>"¿Deseas añadir más admin?"</i> abrirá una ventana emergente con un formulario para poder añadir otro admin.</p>
    <p class="card-text text-left"><img class="mp" src="{{asset('/img/modulo_pertenece.png')}}" alt="Super admin"> Este color indica el súper admin  y no puede ser borrado.</p>
    <p class="card-text text-left"><img class="mp" src="{{asset('/img/uf_pertenece.png')}}" alt="Admin"> Este color indica el admin que está logueado y no puede borrarse así mismo.</p>
  </div>
</div>
<!------------------------------------>
<div class="table-responsive">
<table class="table table-hover table-striped">
  <thead>
    <tr>
      <th class="text-center" scope="col">Nombre</th>
      <th class="text-center" scope="col">Apellido</th>
      <th class="text-center" scope="col">Email</th>
      <th class="text-center" scope="col">Acción</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="tbody_mostrar">
@foreach($users as $key => $user)
@if($user->rol =="admin")
@if($user->super_admin == 1)
<tr class="listado_admin bg-secondary">

  @else
  @if(auth()->user()->id == $user->id)
  <tr class="listado_admin bg-info">
  @endif
    @endif
  <td class="text-center nombre_ad">{{ucfirst($user->nombre)}}</td>

  <td class="text-center apellido_ad">{{ucfirst($user->apellido)}}</td>

  <td class="text-center email_ad" rowspan="1">{{$user->email}}</td>

  <td class="text-center" colspan="2"><a title="Actualizar datos del admin" class="modificar_admin" href="#" onClick="actualizar_admin({{$user->id}})"><img class="img_modi img-fluid" src="{{asset('/img/editar.png')}}" alt="editar"></a> <a title="Borrar admin"  class=" borrar_registro"@if(auth()->user()->id != $user->id) href="{{route('delete.admin',['id' => $user->id])}}" @endif>@if($user->id != auth()->user()->id && $user->id != 1)<img class="img_modi img-fluid" src="{{asset('/img/eraser.png')}}"alt="borrar"> @endif @if($user->id == 1) <span> </span> @endif @if($user->id == auth()->user()->id)<span> </span>  @endif</a></td>
  <td></td>
</tr>
<input hidden value="{{$user->id}}" name="new_admins[]">
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
        <form class="form_users"  method="POST" action="{{route('subirDatos.admin')}}">
          @csrf
          @method('POST')
          <h1 class="title_r_profe ml-xl-auto mr-xl-auto my-xl-5">Añadir Admin</h1>
          <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
            <label for="nombre" class="col-sm-2 col-form-label">
              <img class="img_accion img-fluid" src="{{asset('/img/nombre_user.png')}}" alt="Nombre">
            </label>
            <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
              <input type="text" class="form-control py-2 my-2 registrarUser nmbre" id="nombre" name="nombre" placeholder="Introduce tu nombre" value="{{old('nombre')}}" style="width: 28rem;" required>
            </div>
          </div>
          <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
            <label for="p_apellido" class="col-sm-2 col-form-label">
              <img class="img_accion img-fluid" src="{{asset('/img/nombre_user.png')}}" alt="p_apellido">
            </label>
            <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
              <input type="text" class="form-control py-2 my-2 registrarUser nmbre" id="p_apellido" name="p_apellido" placeholder="Introduce tu apellido" value="{{old('p_apellido')}}" style="width: 28rem;" required>
            </div>
          </div>
          <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
            <label for="email" class="col-sm-2 col-form-label">
              <img class="img_accion img-fluid" src="{{asset('/img/correo.png')}}" alt="Correo">
            </label>
            <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
              <input type="email" class="form-control py-2 my-2 registrarUser" id="email" name="email"  value="{{old('email')}}"  placeholder="Introduce el email" style="width: 28rem;" required>
            </div>
          </div>
          <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
            <label for="pssw2" class="col-sm-2 col-form-label">
              <img class="img_accion img-fluid" src="{{asset('/img/pssw_user.png')}}" alt="Password">
            </label>
            <div class="form-group row col-lg-9 col-xl-9 mr-xl-5 ml-xl-auto">
              <input type="password" aria-describedby="passwordHelpBlock" class="form-control py-2 my-2 registrarUser" id="pssw2" name="pssw2" placeholder="Contraseña" style="width: 28rem;" required>
              <small id="passwordHelpBlock" class="form-text text-muted">
                La contraseña debe tener mínimo 8 caracteres, una letra mayuscula y un número.
              </small>
            </div>
          </div>
          <button type="submit" class="boton rBoton btn btn-secondary my-5 btn_users" id="btnEnviar" name="enviar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
@stop