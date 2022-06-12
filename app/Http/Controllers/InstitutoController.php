<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Modulo;
use App\Models\Uf;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use PDF;
class InstitutoController extends Controller
{
/****************************************************************************/
//                                                                          //
//                      ***Apartado Admin***                               //
//                                                                        //
/**************************************************************************/ 
    public function index()
    {
        return view('instituto.login');
    }
    public function createUser()
    {
        $users = User::all();
        $ciclos = Ciclo::all();
       return view('instituto.registrarUsuario',compact('users','ciclos'));
    }
    public function createAdmin()
    {
        $users = User::all();

       return view('instituto.registrarAdmin')->with(['users' => $users]);
    }
    public function home_usuarios()
    {
    
       return redirect()->route('CrearCiclos');
    }
    
    public function createCiclos()
    {
        $ciclos = Ciclo::all();
       return view('instituto.registrarCiclos')->with(['ciclos' => $ciclos]);
    }
    public function createAlumnos()
    {
        $alumnos = Alumno::all();
        $ciclos = Ciclo::all();
        $ufs = Uf::all();
        $modulos = Modulo::all();
       return view('instituto.registrarAlumnos',compact('alumnos','ciclos','ufs','modulos'));
    }
  
    public function createUfs()
    {
        $ufs = Uf::all();
       return view('instituto.registrarUf')->with(['ufs' => $ufs]);
    }
    public function createModulos()
    {
        
        $modulos = Modulo::all();
        $users = User::all();
        $ciclos = Ciclo::all();
       return view('instituto.registrarModulos',compact('modulos','users','ciclos'));
    }
/****************************************************************************/
//                                                                          //
//                      ***Apartado Profesores***                          //
//                                                                        //
/**************************************************************************/
public function home_profe()
    {
        $user_ciclo = Auth()->user()->ciclo; 
        $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
       return view('instituto.home_profe',compact('ciclos'));
    }
    public function ciclo_alumnos()
{
    $alumnos = Alumno::all();
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
    return view('instituto.ciclos_profe',compact('alumnos','ciclos'));
}
public function listado_alumnos()
{
    $alumnos = Alumno::all();
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
    $modulos = Modulo::all();
    return view('instituto.listado_alumnos_profe',compact('alumnos','ciclos','modulos'));
}
public function datos_personales_alumno()
{
    $alumnos = Alumno::all();
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
    return view('instituto.datos_personales_alumno_profe',compact('alumnos','ciclos'));
}
public function evaluacion_alumno($id)
{
    $alumno = Alumno::find($id);
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
    $nota = DB::table('alumno_ufs')->where('alumno_id',$id)->get();

    //$modulo = DB::statement('SELECT DISTINCT(modulos.modulo) FROM modulos JOIN ufs ON modulos.id = ufs.modulo_id;');
    $modulos = DB::table('modulos')->distinct()->join('ufs', 'modulos.id', '=', 'ufs.modulo_id')
    ->select('modulos.*')->get();
    foreach($nota as $ufs){
        $uf[] = Uf::find($ufs->uf_id);
    }

    $consulta = DB::table("ufs")
    ->join('modulos', 'ufs.modulo_id', '=', 'modulos.id')
    ->select(DB::raw("SUM(ufs.horas) as horas_totales"))
    ->where("modulos.ciclo",$user_ciclo)
    ->groupBy(DB::raw("ufs.modulo_id"))
    ->get();
  
    $nota_final = DB::table("alumno_ufs")
    ->join('ufs', 'alumno_ufs.uf_id', '=', 'ufs.id')
    ->join('modulos', 'ufs.modulo_id', '=', 'modulos.id')
    ->select(DB::raw("ROUND((SUM(alumno_ufs.cualificacion*ufs.horas))/SUM(ufs.horas)) AS notas"))
    ->where("modulos.ciclo",$user_ciclo)
    ->where("alumno_ufs.alumno_id",$id)
    ->groupBy(DB::raw("ufs.modulo_id"))
    ->get();



    return view('instituto.evaluacion_alumno',compact('alumno','uf','ciclos','nota','modulos','consulta','nota_final'))->with(['id' => $id]);
}
/* /////////////////////////////////////////////////////////////
public function evaluacion_alumno_modulos()
{
    $alumnos = Alumno::all();
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
    $ufs = Uf::all();
    //$modulo = DB::statement('SELECT DISTINCT(modulos.modulo) FROM modulos JOIN ufs ON modulos.id = ufs.modulo_id;');
    $modulos = DB::table('modulos')->distinct()->join('ufs', 'modulos.id', '=', 'ufs.modulo_id')
    ->select('modulos.*')->get();

    return view('instituto.modulos_impartidos',compact('alumnos','ufs','ciclos','modulos'));
} */ /////////////////////////////////////////////////////////////////

public function evaluacion_alumno_modulos()
{
    $alumnos = Alumno::all();
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();
    $ufs = Uf::all();
    //$modulo = DB::statement('SELECT DISTINCT(modulos.modulo) FROM modulos JOIN ufs ON modulos.id = ufs.modulo_id;');
    $modulos = DB::table('modulos')->distinct()->join('ufs', 'modulos.id', '=', 'ufs.modulo_id')
    ->select('modulos.*')->get();

    return view('instituto.modulos_impartidos',compact('alumnos','ufs','ciclos','modulos'));
}
public function modulos_impartidos($id)
{
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclos = Ciclo::where('ciclo',$user_ciclo)->get();

    $modulos = Modulo::find($id);
 
    $alumnos = DB::table("alumnos")
    ->join('alumno_ufs', 'alumnos.id', '=', 'alumno_ufs.alumno_id')
    ->join('ufs', 'alumno_ufs.uf_id', '=', 'ufs.id')
    ->join('modulos', 'ufs.modulo_id', '=', 'modulos.id')
    ->select(DB::raw("alumnos.nombre, alumnos.apellido, alumnos.id"))
    ->where("alumnos.ciclo",$user_ciclo)
    ->where("modulos.id",$id)
    ->groupBy(DB::raw("alumnos.nombre, alumnos.apellido, alumnos.id"))
    ->get();

    $ufs = DB::table("ufs")
    ->join('modulos', 'ufs.modulo_id', '=', 'modulos.id')
    ->select(DB::raw("CONCAT(ufs.nombre, '-', ufs.horas,'h') AS ufs_obt"))
    ->where("modulos.ciclo",$user_ciclo)
    ->where("modulos.id",$id)
    ->get();

    $notas = DB::table("alumno_ufs")
    ->join('alumnos', 'alumno_ufs.alumno_id', '=', 'alumnos.id')
    ->join('ufs', 'alumno_ufs.uf_id', '=', 'ufs.id')
    ->join('modulos', 'ufs.modulo_id', '=', 'modulos.id')
    ->select(DB::raw("alumno_ufs.cualificacion AS nota_uf,alumnos.id AS nota_alumno_id"))
    ->where("alumnos.ciclo",$user_ciclo)
    ->where("modulos.id",$id)
    ->get();


    $nota_final = DB::table("alumno_ufs")
    ->join('ufs', 'alumno_ufs.uf_id', '=', 'ufs.id')
    ->join('modulos', 'ufs.modulo_id', '=', 'modulos.id')
    ->select(DB::raw("ROUND((SUM(alumno_ufs.cualificacion*ufs.horas))/SUM(ufs.horas)) AS notas,alumno_ufs.alumno_id"))
    ->where("modulos.ciclo",$user_ciclo)
    ->where("modulos.id",$id)
    ->groupBy(DB::raw("modulos.id,alumno_ufs.alumno_id"))
    ->get();
    
    return view('instituto.alumnos_inscrito_modulo',compact('alumnos','ufs','ciclos','modulos','notas','nota_final'))->with(['id' => $id]);

}

public function comentar_modulo(Request $request){
    $modulo = Modulo::find($request->idcomentario);
    $modulo->comentarios=$request->comentario;
    $modulo->save();
    return back()->with('mensaje', 'Comentario añadido con exito');
}

}
