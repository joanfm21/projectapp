<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ciclo;
use App\Models\Modulo;
use App\Models\Alumno;
use App\Models\Uf;
use App\Models\AlumnoUf;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsuarios();
        self::seedCiclos();
        self::seedModulos();
        self::seedAlumnos();
        self::seedUfs();
        self::seedNotas();
 
      
    }
    public function seedUsuarios(){  
        DB::table('users')->delete();
    
            $user = new User;
            $user->nombre = 'admin';
            $user->apellido = 'admin';
            $user->email = 'admin@admin';
            $user->password =  Hash::make('123');
            $user->rol = 'admin';
            $user->usuario_modi =null;
            $user->super_admin = 1;
            $user->save();

            $profe = new User;
            $profe->nombre = 'Lucas';
            $profe->apellido = 'Guzman';
            $profe->email = 'lucas@inscamidemar.cat';
            $profe->password =  Hash::make('123');
            $profe->ciclo = 'daw';
            $profe->rol = 'profesor';
            $profe->usuario_modi = null;
            $profe->super_admin = 0;
            $profe->save();

            $profe2 = new User;
            $profe2->nombre = 'Pedro';
            $profe2->apellido = 'Soza';
            $profe2->email = 'p@inscamidemar.cat';
            $profe2->password =  Hash::make('123');
            $profe2->ciclo = 'asix';
            $profe2->rol = 'profesor';
            $profe2->usuario_modi = null;
            $profe2->super_admin = 0;
            $profe2->save();
    
    }
    public function seedAlumnos(){  
        DB::table('alumnos')->delete();
    
            $alumno = new Alumno;
            $alumno->dni = '54761569h';
            $alumno->nombre = 'gabriel';
            $alumno->apellido =  'taveras';
            $alumno->direccion = 'avg_generalitat';
            $alumno->telefono = "666380241";
            $alumno->cp = "43880";
            $alumno->fecha_nacimiento = '1999-06-27';
            $alumno->correo = 'g@inscamidemar.cat';
            $alumno->ciclo = 'daw';
            $alumno->usuario_modi = null;
            $alumno->save();

            
            $alumno2 = new Alumno;
            $alumno2->dni = '547615785a';
            $alumno2->nombre = 'Lucas';
            $alumno2->apellido =  'Gimenez';
            $alumno2->direccion = 'avg imperial';
            $alumno2->telefono = "623568974";
            $alumno2->cp = "43730";
            $alumno2->fecha_nacimiento = '1999-02-22';
            $alumno2->correo = 'l@inscamidemar.cat';
            $alumno2->ciclo = 'asix';
            $alumno2->usuario_modi = null;
            $alumno2->save();
    
    }
    public function seedModulos(){  
        DB::table('modulos')->delete();
    
            $modulo = new Modulo;
            $modulo->ciclo = 'daw';
            $modulo->modulo =  'm01';
            $modulo->descripcion_modulo = 'Programación';
            $modulo->comentarios = null;
            $modulo->usuario_id = 2;
            $modulo->ciclo_id = 1;
            $modulo->usuario_modi = null;
            $modulo->save();
            
            $modulo2 = new Modulo;
            $modulo2->ciclo = 'asix';
            $modulo2->modulo =  'm01';
            $modulo2->descripcion_modulo = 'Desarrollo aplicaciones web';
            $modulo2->comentarios = null;
            $modulo2->usuario_id = 3;
            $modulo2->ciclo_id = 2;
            $modulo2->usuario_modi = null;
            $modulo2->save();
    
    }
    public function seedCiclos(){  
        DB::table('ciclos')->delete();
    
            $ciclo = new Ciclo;
            $ciclo->ciclo = 'daw';
            $ciclo->periodo = '2021-09';
            $ciclo->periodo_fin = '2022-06';
            $ciclo->save();
            $ciclo2 = new Ciclo;
            $ciclo2->ciclo = 'asix';
            $ciclo2->periodo = '2021-09';
            $ciclo2->periodo_fin = '2022-06';
            $ciclo2->save();
            
     
    }
    public function seedUfs(){  
        DB::table('ufs')->delete();
    
            $uf1 = new Uf;
            $uf1->nombre = 'uf1';
            $uf1->horas = 20;
            $uf1->descripcion = 'Desarrollo de aplicaciones web';
            $uf1->modulo_id = 1;
            $uf1->usuario_modi = null;
            $uf1->save();

            $uf2 = new Uf;
            $uf2->nombre = 'uf1';
            $uf2->horas = 20;
            $uf2->descripcion = 'Base de datos';
            $uf2->modulo_id = 2;
            $uf2->usuario_modi = null;
            $uf2->save();
        }
        public function seedNotas(){  
            DB::table('alumno_ufs')->delete();
            
            $nota = new AlumnoUf;
            $nota->cualificacion = 1;
            $nota->uf_id = 1;
            $nota->alumno_id = 1;
            $nota->save();
    
            $nota2 = new AlumnoUf;
            $nota2->cualificacion = 1;
            $nota2->uf_id = 2;
            $nota2->alumno_id = 2;
            $nota2->save();
            }  
     
}
