<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\AlumnoUf;
use App\Models\Modulo;
use App\Models\Uf;
use Illuminate\Database\QueryException;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

class AlumnoController extends Controller
{ 
    public function store(Request $request){
        $validatemail = Validator::make($request->all(),[
            'alumno_correo' => ['required','email', 'regex:/(.*)@inscamidemar\.cat$/i'],
        ]);
        $validatedni = Validator::make($request->all(),[
            'alumno_dni' => ['required',  'unique:alumnos,dni', 'regex:/^[0-9]{8}[A-Z]$/i'],
        ]);
        $validatetelefono = Validator::make($request->all(),[
            'alumno_telef' => ['required', 'regex:/^(\+34|0034|34)?[0-9]{3}[0-9]{6}$/i'],
        ]);
        $validatecp = Validator::make($request->all(),[
            'alumno_cp' => ['required', 'digits:5'],
        ]);
        if(($validatemail->fails())){
            return redirect()->back()->with('correoInvalido', 'Solo se perimten los correos: @inscamidemar.cat, prueba con otro');
        }
        if(($validatedni->fails())){
            return redirect()->back()->with('dniInvalido', 'dni invalido o repetido');
        }
        if(($validatetelefono->fails())){
            return redirect()->back()->with('telefono_invalido', 'telefono invalido');
        }
        if(($validatecp->fails())){
            return redirect()->back()->with('cpInvalido', 'cp invalido');
        }
        $alumno = new Alumno;
        $id_ciclo = Str::lower($request->input('select_ciclo'));
        $consulta = DB::table('ciclos')->where('id',$id_ciclo)->first();
        $alumno->ciclo =  Str::lower($consulta->ciclo);
        $alumno->dni = Str::lower($request->input('alumno_dni'));
        $alumno->nombre = Str::lower($request->input('alumno_nombre'));
        $alumno->apellido =  Str::lower($request->input('alumno_apellido'));
        $alumno->direccion =  Str::lower($request->input('alumno_dire'));
        $alumno->telefono = $request->input('alumno_telef');
        $alumno->cp =$request->input('alumno_cp');
        $alumno->fecha_nacimiento =$request->input('alumno_fecha');
        $alumno->correo = Str::lower($request->input('alumno_correo'));
        $alumno->usuario_modi = auth()->user()->nombre;
        $select_alumno = Alumno::select('id')->orderBy('id', 'desc')->first();//devuelve el último alumno

        try{
            if(!(isset($select_alumno))){
                $alumno->save();
            }

            $alumno->save();
            $id_ciclo2 = Str::lower($request->input('select_ciclo'));
            $consulta_ciclo = DB::table('ciclos')->where('id',$id_ciclo2)->first();
            $consulta_modulo = Modulo::select('id')->where('ciclo',$consulta_ciclo->ciclo)->get();
            $consulta_alumno = Alumno::select('id')->orderBy('id', 'desc')->first();//devuelve el último alumno

            foreach($consulta_modulo as $key => $modulo){
                $consulta_uf = DB::table('ufs')->where('modulo_id',$modulo->id)->get();            
                foreach($consulta_uf  as $key => $uf){
                    AlumnoUf::firstOrCreate(['uf_id' => $uf->id, 'alumno_id' => $consulta_alumno->id]);
                }
            }
            return redirect()->back()->with('mensaje', 'Alumno añadido exitosamente'); 
        } catch(QueryException $e){
            $error = $e->errorInfo[1];
            if($error == 1062){
                return redirect()->back()->with('correoOcupado', 'Ya existe este Alumno');
            }
        }
    } 
    public function delete ($id) {
        $alumno = Alumno::find($id);
        $alumno->delete();
        return redirect()->back()->with('mensaje', 'Alumno borrado exitosamente');
    }
    public function update (Request $request) {
        $alumno_dni = $request->input('alumno_dni');
        $alumno_nombre = $request->input('alumno_nombre');
        $alumno_apellido = $request->input('alumno_apellido');
        $alumno_direc = $request->input('alumno_direc');
        $alumno_telef = $request->input('alumno_telef');
        $alumno_cp = $request->input('alumno_cp');
        $alumno_fn = $request->input('alumno_fn');
        $alumno_correo = $request->input('alumno_correo');
        $alumno_ciclo = $request->input('select_ciclo_alumno');
        $id_alumnos = $request->input('new_alumnos');
        $c = $request->input('actualizar_alumno');
        
        foreach($id_alumnos as $key => $p){
            if(isset($c[$key])){
                try{
                    if($alumno_fn[$key] == null){
                        return redirect()->back()->with('correoOcupado', 'Los campos tienen que tener algún valor');
                    }else{
                    DB::table('alumnos')
                    ->where('id',$c[$key])
                    ->update(array('dni' => Str::lower($alumno_dni[$key]),
                    'nombre' => Str::lower($alumno_nombre[$key]),
                    'apellido' => Str::lower($alumno_apellido[$key]),
                    'direccion' => Str::lower($alumno_direc[$key]),
                    'telefono' => Str::lower($alumno_telef[$key]),
                    'cp' => Str::lower($alumno_cp[$key]),
                    'fecha_nacimiento' => Str::lower($alumno_fn[$key]),
                    'correo' => Str::lower($alumno_correo[$key]),
                    'ciclo' => Str::lower($alumno_ciclo[$key]),));
                    }
                } catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1062){
                        return redirect()->back()->with('correoOcupado', 'Este profesor ya existe, prueba con otro');
                    }
                }
            }else{
                $nal = $request->input('actualizar_alumno');
                $buscar_alumno = Alumno::find($nal);
                
                foreach($buscar_alumno as $k => $datos_al){
                    if(!($request->input('select_ciclo_alumno')[$k] == '')){
                        $datos_al->ciclo = Str::lower($request->input('select_ciclo_alumno')[$k]);
                    }
                    if(!($request->input('alumno_dni')[$k] == '')){
                        $validate = Validator::make($request->all(), [
                            'alumno_dni' => ['required',  'unique:alumnos,dni', 'regex:/^[0-9]{8}[A-Z]$/i'][$k],
                        ]);
                        if (!$validate->fails()){
                            $datos_al->dni = Str::lower($request->input('alumno_dni')[$k]);
                        }
                        else {
                            return redirect()->back()->with('dniInvalido', 'dni invalido o repetido');
                        }
                    }
                    if(!($request->input('alumno_nombre')[$k] == '')){
                        $datos_al->nombre = Str::lower($request->input('alumno_nombre')[$k]);
                    }
                    if(!($request->input('alumno_apellido')[$k] == '')){
                        $datos_al->apellido = Str::lower($request->input('alumno_apellido')[$k]);
                    }
                    if(!($request->input('alumno_direc')[$k] == '')){
                        $datos_al->direccion = Str::lower($request->input('alumno_direc')[$k]);
                    }
                    if(!($request->input('alumno_telef')[$k] == '')){
                        $validate = Validator::make($request->all(), [
                            'alumno_telef' => ['required', 'regex:/^(\+34|0034|34)?[0-9]{3}[0-9]{6}$/i'][$k],
                        ]);
                        if (!$validate->fails()){
                            $datos_al->telefono = $request->input('alumno_telef')[$k];
                        }
                        else {
                            return redirect()->back()->with('telefono_invalido', 'telefono invalido');
                        }
                    }
                    if(!($request->input('alumno_cp')[$k] == '')){
                        $validate = Validator::make($request->all(), [
                               'alumno_cp' => ['required', 'digits:5'][$k],
                            ]);
                            if (!$validate->fails()){
                                $datos_al->cp = $request->input('alumno_cp')[$k];
                            }
                            else {
                                return redirect()->back()->with('cpInvalido', 'cp invalido');
                            }
                        }
                        if(!($request->input('alumno_fn')[$k] == '')){
                            $datos_al->fecha_nacimiento = $request->input('alumno_fn')[$k];
                        }
                        if(!($request->input('alumno_correo')[$k] == '')){
                            $validate = Validator::make($request->all(), [
                                'alumno_correo' => ['required', 'email', 'regex:/^[a-z0-9]{1,}@inscamidemar\.cat$/i'][$k],
                            ]);
                            if (!$validate->fails()){
                                $datos_al->correo = Str::lower($request->input('alumno_correo')[$k]);
                            }
                            else {
                                return redirect()->back()->with('correoInvalido', 'Solo se permiten los correos de @inscamidemar.cat, prueba con otro');

                            }
                        }
                        try{
                            $datos_al->save();
                            return redirect()->back()->with('mensaje', 'Alumno actualizado exitosamente'); 
                        } catch(QueryException $e){
                            $error = $e->errorInfo[1];
                            if($error == 1062){
                                return redirect()->route('registrar.alumno')->with('correoOcupado', 'Ya existe este alumno');
                            }
                        }
                    }
                }
            }
        }
    }