@extends('layouts.master_admin')

@section('div_derecho')
    <link rel="stylesheet" href="{{asset('/css/responsiv.css')}}" />

@if(session('mensaje'))
<div class="alert alert-success">
  {{session('mensaje')}}
</div>
@endif
<form class="login w-50 my-5" method="POST" action="{{ route('loginU') }}">
  @csrf
  @method('POST')
  <h1 class="login_t text-center col-lg-1 mr-lg-auto my-lg-5 mr-xl-auto my-xl-5 w-100">Iniciar Sesión</h1>
  <div class="form-group row ciclo_form col-xl-9 mr-xl-5 ml-xl-auto">
    <label for="nombre" class="col-sm-2 col-form-label">
      <img class="img-fluid img_login" src="{{asset('/img/correo.png')}}" alt="Correo">
    </label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="correo" name="email" placeholder="Correo Electronico" style="width: 28rem;" value="{{old('email')}}">
      {{$errors->first('email'),'<span class="help-block">:message</span>'}}
    </div>
  </div>
  <div class="form-group row col-xl-9 mr-xl-5 ml-xl-auto">
    <label for="pssw" class="col-sm-2 col-form-label">
      <img class="img-fluid img_login" src="{{asset('/img/pssw_user.png')}}" alt="Password">
    </label>
    <div class="col-sm-10 ">
      <input type="password" class="form-control" id="pssw" name="password" placeholder="Contraseña" style="width: 28rem;" >
      {{$errors->first('password'),'<span class="help-block">:message</span>'}}
    </div>
  </div>
  <div class="form-group row captcha" >
    <div class="col-md-8 R_captcha col-lg-1 md-offset-2" >
      {!! NoCaptcha::renderJs() !!}
      {!! NoCaptcha::display() !!}
      @if($errors->has('msg'))
      <h4>{{$errors->first()}}</h4>
      @endif
    </div>
  </div>
  <div class="flex items-center justify-end mt-4 form-group row recordarPssw">
    @if (Route::has('password.request'))
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
      {{ __('Has olvidado tu contraseña?') }}
    </a>
    @endif
  </div>
  <button type="submit" class="btn_enviar_login btn btn-secondary my-4" id="btnEnviar" name="enviar">Enviar</button>
</form>
@stop