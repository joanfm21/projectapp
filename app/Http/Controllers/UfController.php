<?php

namespace App\Http\Controllers;

use App\Models\AlumnoUf;
use App\Models\Uf;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class UfController extends Controller
{
    public function store(Request $request){ 
        $uf = new Uf;
    
       
        $uf->nombre = Str::lower($request->input('nombre_uf'));
        $uf->horas = $request->input('horas_uf');
        $uf->descripcion =  Str::lower($request->input('descrip_uf'));
        $uf->modulo_id = $request->input('modulo_id');
        $uf->usuario_modi = auth()->user()->nombre;
        $consulta_uf = Uf::select('id')->orderBy('id', 'desc')->first();//devuelve la últina uf insertada
        
        try{
            //Guardar en la tabla alumnoUF// 
            if(!(isset($consulta_uf))){
                $uf->save();
            }
            $uf->save();

            $ciclo = $request->input('ciclo');
            $consulta_alumno = DB::table('alumnos')->where('ciclo',$ciclo)->get();
            $select_uf = Uf::select('id')->orderBy('id', 'desc')->first();//devuelve la últina uf insertada
            
            foreach($consulta_alumno as $key => $alumno){
                AlumnoUf::firstOrCreate(['uf_id' => $select_uf->id, 'alumno_id' => $alumno->id]);
            }
            return redirect()->back()->with('mensaje', 'Uf añadida exitosamente'); 
        } catch(QueryException $e){
            $error = $e->errorInfo[1];
            if($error == 1062){
                return redirect()->back()->with('correoOcupado', 'Ya existe esta Uf');
            }
        }
    }
    public function update (Request $request) {
        
        $nombre_uf = $request->input('uf_nombre');
        $descrip_uf = $request->input('uf_descrip');
        $horas_uf = $request->input('uf_horas');
        $id_ufs = $request->input('new_ufs');
        $c = $request->input('actualizar_uf');
        
        foreach($id_ufs as $key => $p){
            if(isset($c[$key])){
                try{
                    if($horas_uf[$key] == null){
                        return redirect()->back()->with('correoOcupado', 'Los campos tienen que tener algún valor');
                    }else{
                        DB::table('ufs')->where('id',$c[$key])->update(array('nombre' => Str::lower($nombre_uf[$key]),'descripcion' => Str::lower($descrip_uf[$key]),'horas' => Str::lower($horas_uf[$key]),));
                    }
                } catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1062){
                        return redirect()->back()->with('correoOcupado', 'Esta uf ya existe, prueba con otro');
                    }
                }
            }else{
                $nuf = $request->input('actualizar_uf');
                $buscar_uf = Uf::find($nuf);
                
                foreach($buscar_uf as $k => $datos_f){
                    if(!(Str::lower($request->input('uf_nombre')[$k]) == '')){
                        $datos_f->nombre = Str::lower($request->input('uf_nombre')[$k]);
                    }
                    if(!(Str::lower($request->input('uf_descrip')[$k])== '')){
                        $datos_f->descripcion = Str::lower($request->input('uf_descrip')[$k]);
                    }
                    if(!(Str::lower($request->input('uf_horas')[$k]) == '')){
                        $datos_f->horas = Str::lower($request->input('uf_horas')[$k]);
                    }
                    $datos_f->usuario_modi = auth()->user()->nombre;
                    try{
                        $datos_f->save();
                        return redirect()->back()->with('mensaje', 'Uf actualizado exitosamente'); 
                    } catch(QueryException $e){
                        $error = $e->errorInfo[1];
                        if($error == 1062){
                            return redirect()->back()->with('correoOcupado', 'Ya existe esta uf');
                        }
                    }
                }
             }
            }
            return redirect()->back()->with('mensaje', 'Ufs actualizados exitosamente');  
        }
        public function delete ($id) {
        $uf = Uf::find($id);
        $uf->delete();
        return redirect()->back()->with('mensaje', 'Uf borrada exitosamente');
    }
}
