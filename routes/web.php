<?php

use App\Http\Controllers\InstitutoController;
use App\Http\Controllers\LoginUsersController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\UfController;
use App\Http\Controllers\ModuloImpartidoController;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\EvaluacionAlumnoController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\ExportarNotasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[InstitutoController::class,'index'])->name('inicio')->middleware('guest');

/**********Rutas admin**********/
Route::group(['middleware' => 'admin'], function () {

    Route::get('registrar_usuarios',[InstitutoController::class,'createUser'])->name('registroUser');// Registrar profesores

    Route::get('registrar_admin',[InstitutoController::class,'createAdmin'])->name('registroAdmin'); //Registrar Admin
    
    Route::get('registrar_ciclos',[InstitutoController::class,'createCiclos'])->name('CrearCiclos');  //Registrar Ciclos

    Route::get('/welcome_home', [InstitutoController::class,'home_usuarios'])->name('home_user');//Home admin

    Route::post('/subirDatosUsuarios', [UserController::class,'store'])->name('subirDatos'); //Guardar datos profesores
    
    Route::post('/subirDatosAdmin', [UserController::class,'store_admin'])->name('subirDatos.admin');// Guardar datos admin
    
    Route::post('/subirDatosCiclos', [CicloController::class,'d_ciclos'])->name('ciclos.datos');//Guardar datos ciclos

    Route::post('/subir_datos_alumnos',[AlumnoController::class,'store'])->name('subir.alumno');//Guardar datos alumnos

    Route::post('/subir_datos_modulos',[ModuloController::class,'r_modulos'])->name('subir.modulo');//Guardar datos modulos

    Route::post('/actualizar_alumnos',[AlumnoController::class,'update'])->name('actualizar.alumno');//Actualizar datos alumnos

    Route::post('/actualizar_profesores',[UserController::class,'update_profes'])->name('actualizar.profesores');//Actualizar datos profesores

    Route::post('/actualizar_admin',[UserController::class,'update_admin'])->name('actualizar.admin');//Actualizar datos admin

    Route::post('/actualizar_modulos',[ModuloController::class,'update'])->name('actualizar.modulo');//Actualizar datos modulos

    Route::post('/actualizar_ciclos',[CicloController::class,'update_ciclo'])->name('actualizar.ciclo');//Actualizar datos ciclos

    Route::post('/actualizar_uf',[UfController::class,'update'])->name('actualizar.uf');//Actualizar datos Ufs

    Route::post('/subir_datos_uf',[UfController::class,'store'])->name('subir.uf');//Guardar datos Uf 

    Route::post('/subir_datos_notas',[NotaController::class,'store'])->name('subir.notas');//Guardar datos notas

    Route::get('registrar_modulos',[InstitutoController::class,'createModulos'])->name('registrar.modulos');//Registrar Modulos

    Route::get('registrar_notas',[InstitutoController::class,'createNotas'])->name('registrar.notas');//Registrar notas

    Route::get('registrar_alumnos',[InstitutoController::class,'createAlumnos'])->name('registrar.alumno');//Registrar Alumno

    Route::get('delete_alumnos/{id}',[AlumnoController::class,'delete'])->name('delete.alumno');//Borrar Alumno

    Route::get('delete_profesores/{id}',[UserController::class,'delete'])->name('delete.profesor');//Borrar profesor

    Route::get('delete_admin/{id}',[UserController::class,'delete_admin'])->name('delete.admin');//Borrar admin

    Route::get('delete_modulo/{id}',[ModuloController::class,'delete'])->name('delete.modulo');//Borrar modulo

    Route::get('delete_uf/{id}',[UfController::class,'delete'])->name('delete.uf');//Borrar uf

    Route::get('delete_ciclo/{id}',[CicloController::class,'delete'])->name('delete.ciclo');//Borrar ciclo

    Route::get('registrar_ufs',[InstitutoController::class,'createUfs'])->name('registrar.uf');//Registrar Uf

});
/****************Rutas Profe************************************/
Route::group(['middleware' => 'profe'], function () {
    
    Route::get('/welcome_home_profe', [InstitutoController::class,'home_profe'])->name('home_profe');//Home profesores

    Route::get('listado_alumnos',[InstitutoController::class,'listado_alumnos'])->name('lista.alumnos');//Listar alumnos

    Route::get('datos_personales_alumno',[InstitutoController::class,'datos_personales_alumno'])->name('datosP.alumnos');//Datos personales alumnos

    Route::get('evaluacion_alumno/{id}',[InstitutoController::class,'evaluacion_alumno'])->name('evaluacion.alumno');//Evaluación del alumno
    
    Route::get('modulos_impartidos',[InstitutoController::class,'evaluacion_alumno_modulos'])->name('modulos.impartidos');//Evaluación del alumno

    Route::get('alumnos_de_un_modulo/{id}',[InstitutoController::class,'modulos_impartidos'])->name('select.alumnoModu');//Seleccionar alumno de un determinado módulo

    Route::get('ciclo_profesor',[InstitutoController::class,'ciclo_alumnos'])->name('ciclo.profesor');//Seleccionar opción

    Route::get('actualizar_nota',[EvaluacionAlumnoController::class,'update_notas'])->name('notas.alumno');//Actualizar nota

   // Route::get('estadistica_por_alumno',[EstadisticasController::class,'estadisticas_por_alumno'])->name('estadistica');//Estadisitica

    Route::get('actualizar_nota_modu',[ModuloImpartidoController::class,'update_notas_modulos'])->name('modu.alumno_nota');//Actualizar nota de un determinado módulo
    
    Route::post('/comentarmodulo', [InstitutoController::class,'comentar_modulo'])->name('comentar.modulo');

    // AGREGAR RUTA NUEVA PARA EXPORTAR EL PDF
    Route::get('exportar_notas_pdf/{id}',[ExportarNotasController::class,'exportar_notas_pdf'])->name('exportar_notas_pdf.alumno');
    Route::get('exportar_notas_email/{id}', [ExportarNotasController::class, 'exportar_notas_email'])->name('exportar_notas_email.alumno');
    // --------------------
});
/*****************************************************************/

Route::get('/logout_', [LoginUsersController::class,'destroy'])->name('fin_session');//Cerrar sesión

Route::post('/logins', [LoginUsersController::class,'store'])->name('loginU');

Route::get('/login',function(){
    return redirect('/')->with('mensaje', 'Contraseña actualizado exitosamente');;
})->name('login');//Redirigir al login al restablecer la contraseña

