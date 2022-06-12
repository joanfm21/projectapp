<?php

namespace App\Http\Controllers;

use App\Models\AlumnoUf;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use \Illuminate\Support\Facades\DB;
class EvaluacionAlumnoController extends Controller
{
    public function update_notas (Request $request) {
        
        //$id_nota = $request->input('actualizar_notas');
        $notas =  $request->input('notas_alumno');

        $id_notas = $request->input('new_notas');

        $c = $request->input('actualizar_notas');
        
        foreach($id_notas as $key => $prueba){
            if(isset($c[$key])){
                DB::table('alumno_ufs')->where('id',$c[$key])->update(array('cualificacion' => $notas[$key]));
            }else{
                $p = $request->input('actualizar_notas');
                $nota = AlumnoUf::find($p);
                foreach ($nota as $datos) {
                    if(!$request->input('notas_alumno') == ''){
                        $datos->cualificacion = $request->input('notas_alumno');
                    }
                    try{
                        $datos->save();
                    }
                    catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1366 ){
                        return redirect()->back()->with('mensaje', 'Nota actualizada exitosamente'); 
                    }
                }
            }
    }
}
return redirect()->back()->with('mensaje', 'Notas actualizada exitosamente'); 
}

}
