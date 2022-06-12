<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;
use App\Models\Modulo;
use \Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
class ModuloController extends Controller
{
    public function r_modulos(Request $request){
        
        $modulo = new  Modulo;
        $id_ciclo = $request->input('select_ciclo');
        $consulta = DB::table('ciclos')->where('id',$id_ciclo)->first();
        $modulo->ciclo = Str::lower($consulta->ciclo);
        $modulo->modulo = Str::lower($request->input('nombre_modulo_2'));
        $modulo->descripcion_modulo = Str::lower($request->input('desc_modulo'));
        $modulo->usuario_id = $request->input('select_profe');
        $modulo->ciclo_id = $request->input('select_ciclo');
        $modulo->usuario_modi = auth()->user()->nombre;
        try{
            $modulo->save();
            return redirect()->back()->with('mensaje', 'Módulo añadido exitosamente');
        } catch(QueryException $e){
            $error = $e->errorInfo[1];
            if($error == 1062){
                return redirect()->back()->with('correoOcupado', '¡Este módulo ya exite!, prueba con otro');
            }
        }       
    }
    public function update (Request $request) {
        
        $modulo_nombre = $request->input('modulo_nombre');
        $descrip_modulo = $request->input('descrip_modulo');
        $select_ciclo_modu = $request->input('select_ciclo_modu');
        $select_profe_modu = $request->input('select_profe_modu');
        $id_modus = $request->input('new_modulos');
        $c = $request->input('actualizar_modulo');
        
      
        foreach($id_modus as $key => $p){
             if(isset($c[$key])){
                try{
                    $ciclo =  $select_ciclo_modu[$key];
                    $consulta   = Ciclo::select('id')->where('ciclo',$ciclo)->first();

                    DB::table('modulos')->where('id',$c[$key])->update(array('modulo' => Str::lower($modulo_nombre[$key]),'descripcion_modulo' => Str::lower($descrip_modulo[$key]),'usuario_id' => $select_profe_modu[$key],'ciclo' => Str::lower($select_ciclo_modu[$key]),'ciclo_id' => $consulta->id,));
                } catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1062){
                        return redirect()->back()->with('correoOcupado', 'Este Módulo ya existe, prueba con otro');
                    }
                }
            }else{
                $nm = $request->input('actualizar_modulo');
                $buscar_modu = Modulo::find($nm);
                foreach($buscar_modu as $k => $datos_m){
                    $update_ciclo =  Str::lower($request->input('select_ciclo_modu')[$k]);
                    $new_consulta   = Ciclo::select('id')->where('ciclo',$update_ciclo)->first();

                    if(!(Str::lower($request->input('select_ciclo_modu')[$k]) == '')){
                        $datos_m->ciclo = Str::lower($request->input('select_ciclo_modu')[$k]);
                    }
                    if(!(Str::lower($request->input('modulo_nombre')[$k]) == '')){
                        $datos_m->modulo = Str::lower($request->input('modulo_nombre')[$k]);
                    }
                    if(!(Str::lower($request->input('descrip_modulo')[$k]) == '')){
                        $datos_m->descripcion_modulo = Str::lower($request->input('descrip_modulo')[$k]);
                    }
                    if(!(Str::lower($request->input('select_profe_modu')[$k]) == '')){
                        $datos_m->usuario_id = Str::lower($select_profe_modu[$k]);
                    }
                    $datos_m->ciclo_id = $new_consulta->id;
                    $datos_m->usuario_modi = auth()->user()->nombre;
                    try{
                        $datos_m->save();
                        return redirect()->back()->with('mensaje', 'Módulo actualizado exitosamente'); 
                    } catch(QueryException $e){
                        $error = $e->errorInfo[1];
                        if($error == 1062){
                            return redirect()->back()->with('correoOcupado', 'Ya existe este Módulo');
                        }
                    }
                    
                }
            }  
        }
        return redirect()->back()->with('mensaje', 'Módulos actualizados exitosamente');
    }
    public function delete ($id) {
        
        $modulo = Modulo::find($id);
        $modulo->delete();
        return redirect()->back()->with('mensaje', 'Módulo borrado exitosamente');
    }
}