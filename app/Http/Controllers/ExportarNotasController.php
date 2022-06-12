<?php

namespace App\Http\Controllers;
use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\Modulo;
use App\Models\Uf;
use App\Models\User;
use App\Mail\ExportarNotasMail;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

// AGREGAMOS NUEVO CONTROLADOR PARA EXPORTAR LOS ARCHIVOS EN PDF
class ExportarNotasController extends Controller {
  private static function generar_pdf($id) {
    $alumno = Alumno::find($id);
    $nombre = $alumno->nombre;
    $user_ciclo = Auth()->user()->ciclo; 
    $ciclo = Ciclo::where('ciclo',$user_ciclo)->first();
    
    $modulos = Modulo::where('ciclo_id', $ciclo->id)->with(['ufs' => function($query) {
      $query->with('alumnos');
    }])->get();


    $pdf = PDF::loadView('exportar-notas-pdf', compact('alumno', 'ciclo', 'modulos', 'nombre'));

    return $pdf;
  }

  public function exportar_notas_pdf($id) {
    $pdf = self::generar_pdf($id);

    return $pdf->download('archivo.pdf');
  }

  public function exportar_notas_email($id) {
    $alumno = Alumno::find($id);
    $pdf = self::generar_pdf($id);

    $mailResponse = Mail::to($alumno->correo)->send(new ExportarNotasMail($pdf->output()));

    return redirect()->back()->with('mensaje', 'Correo enviado exitosamente'); 

    // return response()->json(["alumno" => $alumno]);
  }
}