<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
        'email' => ['required','email', 'regex:/(.*)@inscamidemar\.cat$/i'],
    ]);
    $validatepassword = Validator::make($request->all(),[
        'pssw2' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-7])(?=.*[\d\x]).*$/'],
    ]);
    
    $user = new User;
    
    if(($validatepassword->fails())){
        return redirect()->back()->with('passwordInvalido', 'la contraseña debe tener minimo 8 caracteres, una letra mayuscula y un numero');
    }
    $clave_encryp = $request->input('pssw2');
    $clave = Hash::make($clave_encryp);
    $user->nombre = Str::lower($request->input('nombre'));
    $user->apellido = Str::lower($request->input('p_apellido'));
    $user->password = $clave;
    $user->rol = 'profesor';
    $id_ciclo = $request->input('select_ciclo');
    $consulta = DB::table('ciclos')->where('id',$id_ciclo)->first();
    if(isset($consulta->ciclo)){
        $user->ciclo = $consulta->ciclo;
    }else{
        $user->ciclo = null;
    }
    $user->usuario_modi =auth()->user()->nombre;
    $user->super_admin = false;
    
    if(!($validate->fails())){
        $user->email = Str::lower($request->input('email'));
    }else{
        return redirect()->back()->with('correoInvalido', 'Solo se perimten los correos: @inscamidemar.cat, prueba con otro');
    }
    try{
        $user->save();
        return redirect()->back()->with('mensaje', 'Profesor añadido exitosamente');
    } catch(QueryException $e){
        $error = $e->errorInfo[1];
        if($error == 1062){
            return redirect()->back()->with('correoOcupado', '¡Este correo ya está en uso!, prueba con otro');
        }
    }
 }
 public function store_admin(Request $request){
     $validate = Validator::make($request->all(),[
         'email' => ['required','email', 'regex:/(.*)@inscamidemar\.cat$/i'],
        ]);
        
        $validatepassword = Validator::make($request->all(),[
            'pssw2' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-7])(?=.*[\d\x]).*$/'],
        ]);
        
        $user = new User;
        
        if(($validatepassword->fails())){
            return redirect()->back()->with('passwordInvalido', 'la contraseña debe tener minimo 8 caracteres, una letra mayuscula y un numero');
        }
        
        $clave_encryp = $request->input('pssw2');
        $clave = Hash::make($clave_encryp);
        $user->nombre = Str::lower($request->input('nombre'));
        $user->apellido = Str::lower($request->input('p_apellido'));
        $user->password = $clave;
        $user->rol = 'admin';
        $user->usuario_modi = null;
        $user->super_admin = false;
        
        if(!($validate->fails())){
            $user->email = Str::lower($request->input('email'));
        }else{
            return redirect()->back()->with('correoInvalido', 'Solo se perimten los correos: @inscamidemar.cat, prueba con otro');
        }
        try{
            $user->save();
            return redirect()->back()->with('mensaje', 'Admin añadido exitosamente');
        } catch(QueryException $e){
            $error = $e->errorInfo[1];
            if($error == 1062){
                return redirect()->back()->with('correoOcupado', '¡Este correo ya está en uso!, prueba con otro');
            }
        }
    }
    public function update_profes (Request $request) {
        $nombre_profe = $request->input('profe_nombre');
        $apellido_profe = $request->input('profe_apellido');
        $email_profe = $request->input('profe_correo');
        $ciclo_profe = $request->input('select_ciclo_profe');
        $id_profes = $request->input('new_profe');
        $c = $request->input('actualizar_profe');
        
        foreach($id_profes as $key => $p){
            if(isset($c[$key])){
                try{
                    DB::table('users')->where('id',$c[$key])->update(array('nombre' => Str::lower($nombre_profe[$key]),'apellido' => Str::lower($apellido_profe[$key]),'email' => Str::lower($email_profe[$key]),'ciclo' => Str::lower($ciclo_profe[$key]),));
                } catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1062){
                        return redirect()->back()->with('correoOcupado', 'Este profesor ya existe, prueba con otro');
                    }
                }
            }else{
                $np = $request->input('actualizar_profe');
                $buscar_profe = User::find($np);
                
                foreach($buscar_profe as $k => $datos_p){
                    if(!(Str::lower($request->input('select_ciclo_profe')[$k]) == '')){
                        $datos_p->ciclo = Str::lower($request->input('select_ciclo_profe')[$k]);
                    }
                    if(!(Str::lower($request->input('profe_nombre')[$k]) == '')){
                        $datos_p->nombre = Str::lower($request->input('profe_nombre')[$k]);
                    }
                    if(!(Str::lower($request->input('profe_apellido')[$k]) == '')){
                        $datos_p->apellido = Str::lower($request->input('profe_apellido')[$k]);
                    }
                    if(!(Str::lower($request->input('profe_correo')[$k]) == '')){
                        $validate = Validator::make($request->all(), [
                           'profe_correo' =>['required', 'email', 'regex:/(.*)@inscamidemar\.cat$/i'][$k],
                        ]);
                        
                        if (!$validate->fails()){
                            $datos_p->email = Str::lower($request->input('profe_correo')[$k]);
                        }
                        else {
                            return redirect()->back()->with('correoInvalido', 'Solo se permiten los correos de @inscamidemar.cat, prueba con otro');
                        }
                    }
                    $datos_p->usuario_modi = auth()->user()->nombre;
                    try{
                        $datos_p->save();
                        return redirect()->back()->with('mensaje', 'Profesor añadido exitosamente');
                    } catch(QueryException $e){
                        $error = $e->errorInfo[1];
                        if($error == 1062){
                            return redirect()->back()->with('correoOcupado', '¡Este correo ya está en uso!, prueba con otro');
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('mensaje', 'Profesores actualizados exitosamente');
    }
    public function update_admin (Request $request) {
        
        $nombre_ad = $request->input('admin_nombre');
        $apellido_ad = $request->input('admin_apellido');
        $email_ad = $request->input('admin_correo');
        $id_admins = $request->input('new_admins');
        $c = $request->input('actualizar_admin');
        
        foreach($id_admins as $key => $p){
            if(isset($c[$key])){
                try{
                    DB::table('users')->where('id',$c[$key])->update(array('nombre' => Str::lower($nombre_ad[$key]),'apellido' => Str::lower($apellido_ad[$key]),'email' => Str::lower($email_ad[$key]),));
                } catch(QueryException $e){
                    $error = $e->errorInfo[1];
                    if($error == 1062){
                        return redirect()->back()->with('correoOcupado', 'Este admin ya existe, prueba con otro');
                    }
                }
            }else{
                $nwad = $request->input('actualizar_admin');
                $buscar_admin = User::find($nwad);
                foreach($buscar_admin as $k => $datos_ad){
                    if(!(Str::lower($request->input('admin_nombre')[$k]) == '')){
                        $datos_ad->nombre = Str::lower($request->input('admin_nombre')[$k]);
                    }
                    if(!(Str::lower($request->input('admin_apellido')[$k]) == '')){
                        $datos_ad->apellido = Str::lower($request->input('admin_apellido')[$k]);
                    }
                    if(!(Str::lower($request->input('admin_correo')[$k]) == '')){
                        $validate = Validator::make($request->all(), [
                            'admin_correo' => ['required', 'email', 'regex:/(.*)@inscamidemar\.cat$/i'][$k],
                        ]);
                        if (!$validate->fails()){
                            $datos_ad->email = Str::lower($request->input('admin_correo')[$k]);
                        }
                        else {
                            return redirect()->back()->with('correoInvalido', 'Solo se permiten los correos de @inscamidemar.cat, prueba con otro');
                        } 
                    }
                    $datos_ad->usuario_modi = auth()->user()->nombre;
                    try{
                        $datos_ad->save();
                        return redirect()->back()->with('mensaje', 'Admin actualizado exitosamente');
                    } catch(QueryException $e){
                        $error = $e->errorInfo[1];
                        if($error == 1062){
                            return redirect()->back()->with('correoOcupado', '¡Este Admin ya exite!, prueba con otro');
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('mensaje', 'Admins actualizados exitosamente');
    }
    public function delete ($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('mensaje', 'Profesor borrado exitosamente');
    }
    public function delete_admin ($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('mensaje', 'Admin borrado exitosamente');
    }
}
