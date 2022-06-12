<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <title></title>
  </head>
  <body class='w-100'>
    <header>
      <h1 class='h1 text-center'>Boletín de Notas {{ strtoupper($ciclo->ciclo) }}</h1>

      <h3 class='h3 text-center'>Alumno: {{ucfirst($alumno->nombre)}} {{ucfirst($alumno->apellido)}} </h3>
    </header>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" scope="col">ID Módulo</th>
            <th class="text-center" scope="col">Descripción</th>
            <th class="text-center" scope="col">Horas totales</th>
            <th class="text-center" scope="col">Nota Media</th>
          </tr>
        </thead>

      <tbody>
        <!-- ////////// -->
        @foreach($modulos as $moduloValue)
          @php
            $totalCualificacion = $moduloValue->ufs->reduce(function ($acc, $val) use ($alumno) {
              $cualificacionActual = collect($val["alumnos"])->where("nombre", $alumno->nombre)->first()->pivot["cualificacion"];
            
              return $acc + ($val["horas"] * $cualificacionActual); 
            }, 0);

            $totalHorasRelativas = $moduloValue->ufs->reduce(function ($acc, $val) { return $acc + $val["horas"]; }, 0);

            $moduloCualificacion = round($totalCualificacion / $totalHorasRelativas)
          @endphp
        <!-- ////////// -->

        <tr class="bg-dark text-white">
          <td class="text-center">{{$moduloValue->modulo}}</td>
          <td class="text-center">{{$moduloValue->descripcion_modulo}}</td>
          <td class="text-center">{{$moduloValue->ufs->reduce(function ($acc, $val) { return $acc + $val["horas"]; }, 0)}}</td>
          <td class="text-center">{{$moduloCualificacion}}
        </td>
        </tr>
        <tr>
          <td colspan="4">
            <table class="table">
              <thead class="bg-light">
                <th class="text-center" scope="col">ID UF</th>
                <th class="text-center" scope="col">Descripción</th>
                <th class="text-center" scope="col">Horas</th>
                <th class="text-center" scope="col">Evaluación</th>
              </thead>

              <tbody>
                @foreach($moduloValue->ufs as $uf)
                <tr>
                  <td class="text-center">{{$uf->nombre}}</td>
                  <td class="text-center">{{$uf->descripcion}}</td>
                  <td class="text-center">{{$uf->horas}}</td>
                  <td class="text-center">{{$uf->alumnos->where("nombre", $alumno->nombre)->first()->pivot["cualificacion"]}}</td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
</body>