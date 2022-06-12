<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\DB;

class CicloController extends Controller
{
    public function d_ciclos(Request $request){
        //  $ciclos = Ciclo::all();
          $ciclo = new Ciclo;
          $ciclo->ciclo = Str::lower($request->input('nombre_ciclo'));
          $ciclo->periodo = Str::lower($request->input('periodo'));
          $ciclo->periodo_fin = Str::lower($request->input('periodo_fin'));
          $ciclo->usuario_modi = auth()->user()->nombre;
          
          try{
            $ciclo->save();
            return redirect()->back()->with('mensaje', 'Ciclo añadido exitosamente');
        } catch(QueryException $e){
            $error = $e->errorInfo[1];
            if($error == 1062){
                return redirect()->back()->with('correoOcupado', '¡Este ciclo ya exite!, prueba con otro');
            }
        }  
    }
    public function update_ciclo (Request $request) {
        $ciclo = $request->input('ciclo_nombre');
        $periodo = $request->input('ciclo_periodo');
        $periodo_fin = $request->input('ciclo_periodo_fin');
        $id_ciclo = $request->input('new_ciclos');
        $c = $request->input('actualizar_ciclo');

        foreach($id_ciclo as $key => $p){
            if(isset($c[$key])){
                try{
                    if($periodo[$key] == null || $periodo_fin[$key] == null){
                        return redirect()->back()->with('correoOcupado', 'Los campos tienen que tener algún valor');
                    }else{
                        DB::table('ciclos')->where('id',$c[$key])->update(array('ciclo' => Str::lower($ciclo[$key]),'periodo' => $periodo[$key],'periodo_fin' => $periodo_fin[$key],));
                    }
                } catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1062){
                        return redirect()->back()->with('correoOcupado', 'Este ciclo ya existe, prueba con otro');
                    }
                }
            }else{
                $nc = $request->input('actualizar_ciclo'); 
                $buscar_ciclo = Ciclo::find($nc);
                foreach($buscar_ciclo as $k => $datos_c){
                    if(!(Str::lower($request->input('ciclo_nombre')[$k]) == '')){
                        $datos_c->ciclo = Str::lower($request->input('ciclo_nombre')[$k]);
                    }
                    if(!($request->input('ciclo_periodo')[$k] == '')){
                        $datos_c->periodo = $request->input('ciclo_periodo')[$k];
                    }
                    if(!($request->input('ciclo_periodo_fin')[$k] == '')){
                        $datos_c->periodo_fin = $request->input('ciclo_periodo_fin')[$k];
                    }

                    $datos_c->usuario_modi = auth()->user()->nombre;
                    try{
                        $datos_c->save();
                        return redirect()->back()->with('mensaje', 'Ciclo actualizado exitosamente');
                   
                    } catch(QueryException $e){
                        $error = $e->errorInfo[1];
                        if($error == 1062){
                            return redirect()->back()->with('correoOcupado', 'Este ciclo ya existe, prueba con otro');
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('mensaje', 'Ciclos actualizados exitosamente');

    }
          public function delete ($id) {
            $ciclo = Ciclo::find($id);
            $ciclo->delete();
            return redirect()->back()->with('mensaje', 'Ciclo borrado exitosamente');
        }
}
