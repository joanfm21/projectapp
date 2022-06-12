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
